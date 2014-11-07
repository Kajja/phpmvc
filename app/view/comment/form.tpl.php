<div class='comment-form page'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->request->getCurrentUrl()?>">
        <fieldset>
        <legend><?=$fieldlabel?></legend>
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>Epost:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
        <?php if(!$update) : ?>    
            <input type='submit' name='doCreate' value='Lägg till' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
            <input type='reset' value='Rensa'/>
            <input type='submit' name='doRemoveAll' value='Ta bort alla' onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
        <?php else : ?>
            <input type='submit' name='update' value='Uppdatera' onClick="this.form.action = '<?=$this->url->create("comment/update/{$id}")?>'"/>
            <input type='submit' name='cancel' value='Avbryt' onClick="this.form.action = '<?=$this->session->get('context')?>'"/>
        <?php endif; ?>    
        </p>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
