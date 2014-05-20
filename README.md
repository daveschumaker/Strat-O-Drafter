# STRAT-O-DRAFTER
A few friends and I are interested in creating a fantasy baseball league using the Strat-O-Matic board game. Putting together a draft for around 8 teams (x 25 players per team) is a bit time consuming to do by hand.

My ultimate hope is that this nifty little script will allow aspiring Strat-O-Matic commissioners to easily put together both manual and auto-matic drafts.

## Instructions.

1. Put this file into any directory with a server running PHP 5.4.0 or greater.
2. Open up draft_script.php in your favorite browser.

## Todos: Things to do.

These sorts of things are probably buried throughout the script, but I'm listening them here for posterity, hilarity, and general convenience.

1. We also need to reload our initial array so things are ready for a fresh start.
2. Have a way to export all total results.
3. Allow users to input teams and team names and then show the draft results.
4. We shouldn't have 2 different functions for loading pitchers and batters. This should all be in 1 function.
5. Break out lineup sheets from Strat-O-Matic into a different file, so this can easily be imported each season.
6. Track positions and teams of players (makes it easy to find card in box, and also keep track of what positions a team needs to fill)
7. Need a way to rank / evaluate players so the script can fairly construct competitive teams.
8. I need to stop sucking at coding.
