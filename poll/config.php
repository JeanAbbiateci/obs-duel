
<?php

ini_set('display_errors', 'On');


/****************************************************************************
 * DRBPoll
 * http://www.dbscripts.net/poll/
 * 
 * Copyright © 2007-2010 Don B 
 ****************************************************************************/

require_once(dirname(__FILE__) . '/class.php');	// For the Poll class definition

// Modify this string to reflect the URL where DRBPoll is installed.
// A trailing slash must be included.  This URL will be used in the generated 
// HTML for the URL for the form submission.  This may be a relative or 
// absolute URL.
$POLL_URL = 'poll/';

// Names of the form input elements in the poll form.
// You probably won't need to change these unless the names conflict with some 
// other element on your pages.
$POLL_ID_PARAM_NAME = "pollid";
$VOTE_PARAM_NAME = "vote";

// Maximum width of a bar of the poll results, in pixels
// Change this if you want to make the poll bar chart larger 
// or smaller in width.
$MAX_POLL_BAR_WIDTH = 200;

// Whether or not the script should prevent the same IP address 
// from voting multiple times on the same poll.
// Set to FALSE to allow duplicate votes.  
$PREVENT_DUPLICATE_VOTES = TRUE;

// Whether or not vote counts should be displayed. 
// If set to FALSE, only the percentages will be shown.  
$SHOW_COUNTS = TRUE;

// These are the strings that are displayed in the poll control 
// and the result page.
// Modify these to customize what is displayed to the user.
$SUBMIT_BUTTON_STRING = 'Validez votre vote !';
$NUMBER_OF_VOTES_STRING = 'Total des votes : %s';
$VOTE_STRING = 'Vote:';						// Used as label for combobox control type
$VOTE_LIST_DEFAULT_LABEL = 'Selectionner';	// This is the "empty" option when using a combobox
$VIEW_RESULTS_STRING = 'Voir les r&eacute;sultats';
$DUPLICATE_VOTE_ERROR_MSG = 'Vous avez d&eacute;j&agrave; vot&eacute;';
$NO_VOTE_SELECTED_ERROR_MSG = 'Vous n&rsquo;avez rien selectionn&eacute;';

// List of valid polls.  All vote requests are checked against this list 
// to ensure that malicious users do not submit invalid poll IDs through a 
// cross-site request forgery.  
//
// Add or modify the $VALID_POLLS array to add, modify, or remove polls.   
// The key of the $VALID_POLLS associative array represents the poll ID; 
// this value must be a string.  In addition, it must only use alphanumeric 
// characters (A-Z, a-z, and 0-9).
//
// Set the question property of the Poll object to a string representing 
// the question to be displayed.
//
// Call add_value() on the Poll object to add a new value.  The first 
// parameter represents the value ID, which must be a alphanumeric string.  
// The second parameter is the string to display to the user for this value.


$VALID_POLLS = array();	// The keys of this associative array are the poll IDs




/*
 * Import CSV in Table

 */

ini_set('display_errors', 'On');
 
// Set your CSV feed

$gsheetid = '1dFWriXGI0hduAFC41Y-EL3-nLE-HC59COMkLdHGjKrY';
$gsheetsectionid = '0';
$feed = 'https://docs.google.com/spreadsheets/d/' . $gsheetid . '/export?gid=' . $gsheetsectionid . '&format=csv';
 
// Function to convert CSV into associative array
function csvToArray($file, $delimiter) { 
  if (($handle = fopen($file, 'r')) !== FALSE) { 
    $i = 0; 
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
      for ($j = 0; $j < count($lineArray); $j++) { 
        $arr[$i][$j] = $lineArray[$j]; 
      } 
      $i++; 
    } 
    fclose($handle); 
  } 
  return $arr; 
} 
 
// Do it
$data = csvToArray($feed, ',');
array_shift($data);
 
// print_r($data);


foreach ($data as $line) {
  // 1er colonne = $line[0] 
  $p = new Poll;
  $p->question = "";  // Question displayed to the user
  $p->returnToURL = "../polls.php";       // Specify the URL to return to for this poll; may be relative or absolute
  $p->legend = "";            // Form legend; leave empty for none
  $p->control_type = $CONTROL_RADIOBUTTONS;   // Control type; $CONTROL_RADIOBUTTONS or $CONTROL_COMBOBOX
  $p->add_value("1", "Pour moi, le vainqueur est&nbsp;:<br> " . $line[1]);            // Poll value ID and a display string
  $p->add_value("2", "Pour moi, le vainqueur est&nbsp;:<br> " . $line[2]);
  $VALID_POLLS[$line[0]] = $p; 
  
  // echo $line[0] . $line[1] . $line[2] ;

}






// récupérer le CSV d'une sheet
// fonctions PHP pour mettre le CSV dans un tableau PHP  $mon_tableau
/*
foreach ($mon_tableau as $line) {
  // 1er colonne = $line[0]	
  $p = new Poll;
  $p->question = "";	// Question displayed to the user
  $p->returnToURL = "../polls.php";				// Specify the URL to return to for this poll; may be relative or absolute
  $p->legend = "";						// Form legend; leave empty for none
  $p->control_type = $CONTROL_RADIOBUTTONS;		// Control type; $CONTROL_RADIOBUTTONS or $CONTROL_COMBOBOX
  $p->add_value("1", "Pour moi, le vainqueur est : " . $lines[2]);						// Poll value ID and a display string
  $p->add_value("2", "Pour moi, le vainqueur est : " . $lines[3]);
  $VALID_POLLS[$lines[0]] = $p;	
}
*/
?>
