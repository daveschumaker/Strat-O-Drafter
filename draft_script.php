<?php

  // Quick and dirty Stat-O-Matic draft selection script
  // By Dave Schumaker (@davely)

  // todo: We also need to reload our initial array so things are ready for a fresh start.
  // todo: have a way to export total results.
  // todo: Allow users to input teams and team names and then show the draft results.
  // todo: We shouldn't have 2 different functions for loading pitchers and batters. This should all be in 1 function.

  // Get this session started so that we can start drafting players and remember who they are!

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
    //$_SESSION['pitcher_array'] = ""; // Use this to store pitchers and remove them from the array as they are drafted.
    //$_SESSION['batter_array'] = ""; // Use this to store batters and remove them from the array as they are drafted.
  }

  //*****************************************************
  // Setup initial functions and stuff. YEAH!
  //*****************************************************

  function wipe_Rosters() {
    // Use this to wipe out all settings and start fresh.
    unset($_SESSION['batter_array']);
    unset($_SESSION['pitcher_array']);
    unset($_SESSION['drafted_team']);
    unset($batter_array);
    unset($pitcher_array);
    unset($player_result);
  }

  function load_Batters() {
    // DON'T TOUCH THIS! BELOW SHOULD BE FULL ROSTERS FOR BATTERS!!!
    $batters = array(
      "Cabrera, M",
      "Kemp, M",
      "Puig, Y",
      "Trout, M",
      "Tulowitzki, T"
    );

    //$_SESSION['batter_array'] = $batters;
    return $batters;
  }

  function load_Pitchers() {
    // DON'T TOUCH THIS! BELOW SHOULD BE FULL ROSTERS FOR PITCHERS!!!
    $pitchers = array(
      "Greinke, Z",
      "Hammels, C",
      "Kershaw, C",
      "Tanaka, M"
    );

    //$_SESSION['pitcher_array'] = $pitchers;
    return $pitchers;
  }

  function get_Batter() {
    // Draft a random batter, yo!
    $batters = $_SESSION['batter_array'];
    $random_batter = array_rand($batters, 1);
    build_Team($batters[$random_batter]); // Add drafted player to the team
    //debug_Show($_SESSION['batter_array']); // Trying to figure out what's working and not working...
    return $batters[$random_batter];
  }

  function get_Pitcher() {
    // Draft a random pitcher, yo!
    $pitchers = $_SESSION['pitcher_array'];
    $random_pitcher = array_rand($pitchers, 1);
    build_Team($pitchers[$random_pitcher]); // Add drafted player to the team!
    return $pitchers[$random_pitcher];
  }

  function build_Team($new_player) {
    if (isset($_SESSION['drafted_team'])) {
      $old_team = $_SESSION['drafted_team']; // Get the team that we are about to modify
      array_push($old_team, $new_player); // Add a new player to this team
      $_SESSION['drafted_team'] = $old_team;  // Store the value of the newly modified team
    } else {
        $new_team = $new_player;
        $_SESSION['drafted_team'][0] = $new_team;
    }
  }

  // Use this function to display results and values from an array for debugging purposes
  function debug_Show($debug_values) {
    echo "<p><pre>";
    echo "Debug value:<br/>";
    print_r($debug_values);
    echo "</p></pre>";
  }

  //*****************************************************

  // Wait for input from the user and then determine what the heck happens!

  if (isset($_GET['player']) && $_GET['player'] == "load") {
    // Clear rosters
    wipe_Rosters();
    // Use this to initially load default rosters
    $batter_array = load_Batters();
    $pitcher_array = load_Pitchers();

    $_SESSION['batter_array'] = $batter_array;
    $_SESSION['pitcher_array'] = $pitcher_array;
  }

  if (isset($_GET['player']) && $_GET['player'] == "pitcher") {
    $player_result = get_Pitcher();
    //echo "PITCHER SELECTED YOU WIN!<br/><br/>";
  } elseif (isset($_GET['player']) && $_GET['player'] == "batter") {
    $player_result = get_Batter();
    //echo "BATTER SELECTED YOU WIN!<br/><br/>";
  } elseif (isset($_GET['player']) && $_GET['player'] == "clear") {
    // Unset all of the session variables.
    $_SESSION = array();

    //Destroy the session.
    session_destroy();
  } else {
    // Right now, this is the same as the initial "load" page command.
    // todo: Probably need to detect if stuff if already set and stored so we don't overwrite it.

    // Unset all of the session variables.
    $_SESSION = array();

    // Clear rosters
    wipe_Rosters();

    // Use this to initially load default rosters
    $batter_array = load_Batters();
    $pitcher_array = load_Pitchers();

    $_SESSION['batter_array'] = $batter_array;
    $_SESSION['pitcher_array'] = $pitcher_array;
  }

  // Random debugging stuff so I can figure out if things are working.
  // todo: probably remove this or change it to false once things workish...
  $debug = "false";
  if ($debug == "true") {
    echo "<pre>";
    echo "List pitchers:<br/>";
    print_r($pitcher_array);
    echo "<br/>Pitcher session:<br/>";
    print_r($_SESSION['pitcher_array']);
    echo "</pre>";
  }

?>

<html>
	<head>
		<title>Strat-O-Drafter!</title>
	</head>
	<body>

    <div id="container">
      <p>Select one:<br/>
        <a href="draft_script.php?player=pitcher">pitcher</a> or <a href="draft_script.php?player=batter">batter</a> or <a href="draft_script.php?player=load">start over</a>
        <?php
          if (isset($player_result)) {
            echo "<br/>";
            echo $player_result;
            echo "<p>Current Team:</p>";
            debug_Show($_SESSION['drafted_team']);
          }
        ?>
    </div>
	</body>
</html>
