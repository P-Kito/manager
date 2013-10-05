<hr />
<?php echo TextMgr::getText('new_issue', false); ?>
<hr />

    <form class="form">  
      
        <p class="name">  
            <input type="text" name="name" id="name" />  
            <label for="name">Charaktername</label>  
        </p>  
      
        <p class="stufe">  
            <input type="radio" name="stufe" value="player_warn_1"> <?php echo TextMgr::getText('player_warn_1', false); ?>
			<input type="radio" name="stufe" value="player_warn_2"> <?php echo TextMgr::getText('player_warn_2', false); ?>
			<input type="radio" name="stufe" value="player_warn_3"> <?php echo TextMgr::getText('player_warn_3', false); ?>
            <input type="radio" name="stufe" value="player_warn_4"> <?php echo TextMgr::getText('player_warn_4', false); ?>
			<input type="radio" name="stufe" value="player_warn_5"> <?php echo TextMgr::getText('player_warn_5', false); ?>
        </p>  
      
        <p class="web">  
            <input type="text" name="web" id="web" />  
            <label for="web">Website</label>  
        </p>  
      
        <p class="text">  
            <textarea name="text"></textarea>  
        </p>  
      
        <p class="submit">  
            <input type="submit" value="Absenden" />  
        </p>  
      
    </form>  