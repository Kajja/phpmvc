<?php

namespace Anax\Users;

use \Anax\DI\IInjectionaware,
    \Anax\DI\TInjectable,
    \Anax\Users\User;


/**
 * Controller for users
 *
 */
 class UsersController implements IInjectionaware
 {
    use TInjectable;


    /**
     * Initialize the controller
     *
     *
     */
    public function initialize()
    {
        // Create User-model object
        $this->userModel = new User();
        $this->userModel->setDI($this->di);

        // Set class on body-element for styling
        $this->theme->setVariable('bodyClasses', 'page-container');

        $this->theme->setTitle('Användare');
    }

    /**
     * Setup database for test purposes
     *
     */
    public function setUpAction()
    {

        $this->db->dropTableIfExists('user')->execute();
 
        $this->db->createTable('user', [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime'],
            ]
        )->execute();

        // Adds two test users
        $this->db->insert('user', [
            'acronym', 'email', 'name', 'password', 'created', 'active']
        );

        $now = date(DATE_RFC2822);
     
        $this->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
     
        $this->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $this->db->execute([
            'KF',
            'kalle@dbwebb.se',
            'Karl Fransson',
            password_hash('frans', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $this->db->execute([
            'UL',
            'ullis@dbwebb.se',
            'Ulrika Larsson',
            password_hash('ullis', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }


    /**
     * Retrieve all stored users and show in view
     *
     */
    public function listAction() {

        // Use the model to get all stored users
        $allUsers = $this->userModel->findAll();

        // Creates an array with the information to be displayed
        $userInfo = $this->userInfoBuilder([
            'update', 'inactivate', 'activate', 'soft-delete', 'undo-delete', 'hard-delete'
            ], $allUsers);

        // Display the result in a view
        $this->views->add('user/list-all', [
            'title' => 'Alla användare',
            'users' => $userInfo
        ]);
    }


    /**
     *  Retrieve the user with the specified id and display in view
     *
     */
    public function idAction($id = null)
    {
        if (!isset($id)) {
            die('Missing id');
        }
        // Use the model to retrieve the specified user
        $user = $this->userModel->find($id);

        // Display user information in view
        $this->views->add('user/user', [
            'userValues' => $user->getProperties()
        ]);
    }


    /**
     * Add and store a new user
     *
     * @param acronym to be used for the new user
     */

/*
    public function addAction($acronym = null)
    {
        if (!isset($acronym)) {
            die('Missing acronym');
        }

        $now = date(DATE_RFC2822);
     
        $this->userModel->save([
            'acronym' => $acronym,
            'email' => $acronym . '@mail.se',
            'name' => 'Mr/Mrs ' . $acronym,
            'password' => password_hash($acronym, PASSWORD_DEFAULT),
            'created' => $now,
            'active' => $now,
        ]);
 
        // Redirect to display the created user
        $url = $this->url->create('users/id/' . $this->userModel->id);
        $this->response->redirect($url);
    }
*/

    public function addAction()
    {

        // Create HTML form for user creation
        $form = $this->userForm();

        // Form check: 
        //      not submitted => ($form->check = null)
        //      submitted + valid -> run button callback
        //          callback returns true  -> run first check callback   ($form->check = true)
        //          callback returns false -> run second check callback  ($form->check = false)
        //      submitted + not valid -> run second check callback       ($from->check = false)
        $form->check(
            // If the check is successful, save the new user
            function($form) {

                $now = date(DATE_RFC2822);
             
                $this->userModel->save([
                    'acronym'   => $form->Value('acronym'),
                    'name'      => $form->Value('name'),
                    'created'   => $now,
                    'active'    => $now
                ]);

                // Redirect to display the created user
                $url = $this->url->create('users/id/' . $this->userModel->id);
                $this->response->redirect($url);
            },
            // If the check fails
            function($form) {
                $form->addOutput('Något gick fel');
            }
        );

        // Add the created form to a view
        $this->views->add('me/page', [
            'content' => $form->getHTML()
        ]);

    }

    /**
     * Update a user
     *
     * @param id of the user to update
     */
    public function updateAction($id = null) {

        if (!isset($id)) {
            die('Missing id');
        }

        // The user-object, i.e. userModel is populated with data
        // if $id matched a row in the database.
        $this->userModel->find($id);

        // Create HTML-form and populate it with values from database
        $form = $this->userForm($this->userModel->getProperties());

        $form->check(
            // If the check is successful, update user
            function($form) {

                $now = date(DATE_RFC2822);
             
                $this->userModel->save([
                    'acronym'   => $form->Value('acronym'),
                    'name'      => $form->Value('name'),
                    'updated'   => $now
                ]);

                // Redirect to display the created user
                $url = $this->url->create('users/id/' . $this->userModel->id);
                $this->response->redirect($url);
            },
            // If the check fails
            function($form) {
                $form->addOutput('Något gick fel');
            }
        );

        // Add the created form to a view
        $this->views->add('me/page', [
            'content' => $form->getHTML()
        ]);
    }


    /**
     * Delete a user
     *
     * @param user id
     */
    public function deleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }
     
        $res = $this->userModel->delete($id);

        // Redirect to display users
        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }


    /**
     * Soft-delete, the user is not removed from database
     * only marked as deleted.
     *
     * @param id of the user
     *
     */
    public function softDeleteAction($id = null)
    {
        if (!isset($id)) {
            die('Missing id');
        }

        $now = date(DATE_RFC2822);

        $user = $this->userModel->find($id);
        $user->deleted = $now;
        $user->save();

        // Redirect to display user
        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }


    /**
     * Undo a soft-delete
     *
     * @param id of the user
     *
     */
    public function undoDeleteAction($id)
    {
        if (!isset($id)) {
            die('Missing id');
        }

        $now = date(DATE_RFC2822);

        $user = $this->userModel->find($id);
        $user->deleted = null;
        $user->save();

        // Redirect to display user
        $url = $this->url->create('users/waste');
        $this->response->redirect($url);   
    }

    /**
     * Inactivate user
     * 
     * @param user id
     *
     */
    public function inactivateAction($id)
    {
        if (!isset($id)) {
            die('Missing id');
        }

        $user = $this->userModel->find($id);
        $user->active = null;
        $user->save();

        // Redirect to display user
        $url = $this->url->create('users/active');
        $this->response->redirect($url);
    }

    /**
     * Activate user
     * 
     * @param user id
     *
     */
    public function activateAction($id)
    {
        if (!isset($id)) {
            die('Missing id');
        }

        $now = date(DATE_RFC2822);

        $user = $this->userModel->find($id);
        $user->active = $now;
        $user->save();

        // Redirect to display user
        $url = $this->url->create('users/inactive');
        $this->response->redirect($url);
    }


    /**
     * Show the active users
     *
     */
    public function activeAction() 
    {
        $active = $this->userModel->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted is NULL')
            ->execute();

        $userInfo = $this->userInfoBuilder(['update', 'inactivate', 'soft-delete'], $active);

        $this->views->add('user/list-all', [
            'title' => 'Aktiva användare',
            'users' => $userInfo
        ]);
    }


    /**
     * Show inactive users 
     *
     */
    public function inactiveAction() {

        $inactive = $this->userModel->query()
            ->where('active IS NULL')
            ->execute();

        $userInfo = $this->userInfoBuilder(['update', 'activate', 'soft-delete'], $inactive);

        $this->views->add('user/list-all', [
            'title' => 'Inaktiva användare',
            'users' => $userInfo
        ]);
    }


    /**
     * Shows the objects that have been soft-deleted
     *
     */
    public function wasteAction()
    {

        $softDeleted = $this->userModel->query()
            ->where('deleted IS NOT NULL')
            ->execute();

        $userInfo = $this->userInfoBuilder(['hard-delete', 'undo-delete'], $softDeleted);

        $this->views->add('user/list-all', [
            'title' => 'Papperskorg',
            'users' => $userInfo
        ]);

    }


    /**
     * Method that creates a HTML-form for registering
     * and updating Users
     *
     * @param array values to populate field with
     *
     * @return a form object
     */
    public function userForm($values = [])
    {
        // Turn on session, Form-service use it
        $this->session();

        $form = $this->form->create([], [
            'name' => [
                'type' => 'text',
                'label' => 'Namn:',
                'required' => true,
                'validation' => ['not_empty'],
                'value' => isset($values['name']) ? $values['name'] : ''
            ],
            'acronym' => [
                'type' => 'text',
                'label' => 'Akronym:',
                'required' => true,
                'validation' => ['not_empty'],
                'value' => isset($values['acronym']) ? $values['acronym'] : ''          
            ],
            'ok' => [
                'type' => 'submit',
                'callback' => function($form) {
                    return true;
                }
            ]
        ]);
        return $form;
    }


    /**
     * Builds user information to be displayed in list of users
     *
     * @param array which actions to display for every user
     * @param array with User-objects
     *
     * @return array with userinformation
     */
    public function userInfoBuilder($actions, $users)
    {
        $userInfo = [];
        foreach ($users as $key => $user) {

            $id = $user->id;

            $userInfo[$key]['id'] = $id;
            $userInfo[$key]['acronym'] = 
                "<a href=\"{$this->url->create('users/id/' . $id)}\">" . $user->acronym . '</a>';
            $userInfo[$key]['name'] = $user->name;

            // Adds action links to manipulate the user
            if (array_search('update', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/update/' . $id)}\"  title='Uppdatera'><i class='fa fa-pencil'></i></a>";
            }
            if (array_search('inactivate', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/inactivate/' . $id)}\" title='Inaktivera'><i class='fa fa-pause'></i></a>";
            }
            if (array_search('activate', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/activate/' . $id)}\" title='Aktivera'><i class='fa fa-flash'></i></a>";
            }
            if (array_search('soft-delete', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/softdelete/' . $id)}\" title='Släng'><i class='fa fa-trash'></i></a>";
            }
            if (array_search('undo-delete', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/undodelete/' . $id)}\" title='Plocka upp ur papperskorg'><i class='fa fa-recycle'></i></a>";
            }
            if (array_search('hard-delete', $actions) !== false) {
                $userInfo[$key][] = 
                    "<a href=\"{$this->url->create('users/delete/' . $id)}\" title='Radera'><i class='fa fa-remove'></i></a>";
            }
        }
        return $userInfo;
    }


 }