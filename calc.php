<?php





class WageCalculator {


    private $wage = 0;
    private $current_rent = 0;

    // ratios


    const FHA_FRONTEND = 0.31;
    const VA_FRONTEND = 0;
    const USDA_FRONTEND = 0;


    const CONVENTIONAL_BACKEND = 0;
    const FHA_BACKEND = 43;
    const VA_BACKEND = 0;
    const USDA_BACKEND = 0;




//Step 1

// calculate wage if anual  was given


public function annualWageToMonthly($salary){
    $monthly = $salary / 12;
    return this->setWage($monthly);
}


// calculate wage if monthly  was given

function monthlyWageToMonthly($salary){
    $monthly = $salary ;

    return return this->setWage($monthly);
}

// calculate wage if hourly  was given
    function hourlyWageToMonthly($salary){
        $monthly = ($salary * 2080) / 12 ;
        return return this->setWage($monthly);
    }
// calculate wage if bymonthly was given
function bymontlyWageToMonthly($salary){
    $monthly = ($salary * 24) / 12 ;
    return return this->setWage($monthly);
}
// calculate wage if byweekly was given
function byweeklyWageToMonthly($salary){
    $monthly = ($salary * 26) / 12 ;
    return return this->setWage($monthly);
}
// step 2

//multiply front end ratio for all products (FHA, VA, Conventional, USDA)
function frontEndRatioCalculation($loanType, $wage){

}


// multiply back end ratio for all products (FHA, VA, Conventional, USDA)
function backEndRatioCalculation(){

}

// Getters and Setters

    /**
     * @return int
     */
    public function getWage()
    {
        return $this->wage;
    }

    /**
     * @param int $wage
     */
    public function setWage($wage)
    {
        $this->wage = $wage;
    }

}

