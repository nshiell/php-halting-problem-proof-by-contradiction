<?php
/*
 * Proof by contradiction that you can't write any code that
 * can use static analysis (looking at code without running it)
 * that can ALWYAS decide if a program/algorithm will halt (exit/return)
 *
 * @see https://en.wikipedia.org/wiki/Halting_problem
 * @see https://www.cs.virginia.edu/~robins/Turing_Paper_1936.pdf
 */
use HaltingProblemSolver\H;

/**
 * A cheeky "pathalogical" function/algorithm
 * That runs forever if it ummm, won't?
 * ... and conversly halt's (returns/exists) if it errrrr won't?
 * 
 * @param string $programToInspect       Some source code to analyse
 *
 * @param string $programToInspectsInput Some variables to
 *                                       check the code against - i.e. pretend
 *                                       to run inside the code
 */
function hPlus(string $programToInspect, string $programToInspectsInput) {
    $haltingDetector = new H();

    // Give some source code to analyse (but not to eval)
    $haltingDetector->setProgramCodeToStaticallyInspect($programToInspect);

    // Give some variables that the program would use if it where running
    $haltingDetector->setInputToInspectWithProgram($programToInspectsInput);

    // true means the program/algorithm will evenually finish executing
    // given the variable scope
    $itWillHalt = $haltingDetector->willTheProgramHaltWithTheGivenInput();

    // this bit is nasty - and means that there can be NO way to write
    // HaltingProblemSolver\H->willTheProgramHaltWithTheGivenInput()
    // that will ALWAYS work
    if ($itWillHalt) {
        // If this code/function/algorithm is supposed to halt then ...
        while (true) {
            echo 'The program analysed will halt (eventually)' . "\n<br />";
        }
    }

    // If supposed to NOT ever halt then ...
    die('The analysed program will never halt');
}

// Calling hPlus with itself!
$programToInspect = file_get_contents(__file__);
$programToInspectsInput = file_get_contents(__file__);

hPlus($programToInspect, $programToInspectsInput);