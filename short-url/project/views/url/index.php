<div class="container mt-3">
    <form action="/post" method="POST">
        <div class="input-group mb-3">
            <input type="url" name="URL" class="form-control" id="URL"
                   placeholder="Enter the URL" aria-label="Enter the URL" aria-describedby="button-addon">
            <input class="btn btn-outline-secondary" type="submit" id="button-addon" value="Short">
        </div>

    </form>
    <ul class="list-group" style="position: relative">
        <?php
        if (!empty($_COOKIE['shortUrls'])) {
            $shortUrls = json_decode($_COOKIE['shortUrls'], true);
            foreach ($shortUrls as $key=>$value) {
                echo "<li class='list-group-item'>
                        <div class='d-flex'>
                        <div class=' border-end border-secondary-subtle' 
                        style='width: 25%; text-overflow: ellipsis; overflow: hidden;';>
                              <a href=$value class='text-truncate'>$value</a>                  
                        </div>
                            <div class=' ms-2'>http://framework/$key</div>
                        </div>       
                </li>";
            }
        }?>
    </ul>
</div>