<?php

/**
 * It helps a system error to be well displayed
 * 
 * @param string $message the actual message to display
 * 
 * @author Stefano Cipolletta
 */
function display_error(string $message)
{
?>
    <div class='d-flex justify-content-center m-5'>
        <span class='bg-dark text-danger text-center font-weight-bold border border-danger p-2 rounded-3'>
            <?= $message ?>
        </span>
    </div>
<?php
}
