<?php
   $pollid = $_GET['duel'];
   require_once('poll/poll.php');
   show_vote_control($pollid);
?> 