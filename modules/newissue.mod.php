<hr />
<?php echo TextMgr::getText('new_issue', false); ?>
<hr />
<br />
    <form class="form">  
      
        <p class="name">  
            <input type="text" name="name" id="name" />  
            <label for="name">Name</label>  
        </p>  
      
        <p class="email">  
            <input type="text" name="email" id="email" />  
            <label for="email">E-mail</label>  
        </p>  
      
        <p class="web">  
            <input type="text" name="web" id="web" />  
            <label for="web">Website</label>  
        </p>  
      
        <p class="text">  
            <textarea name="text"></textarea>  
        </p>  
      
        <p class="submit">  
            <input type="submit" value="Send" />  
        </p>  
      
    </form>  