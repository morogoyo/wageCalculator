

<!--

need to add years or months to html calculator form





-->






<!DOCTYPE html> <!-- Declare HTML5 document -->
<html lang="en"> <!-- Set language to English -->
<head>
    <meta charset="UTF-8" /> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- Ensure mobile responsiveness -->
    <title>Home Affordability Calculator</title> <!-- Set the browser tab title -->

    <!-- Load Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Load Chart.js for visualizing affordability -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!---->
<div class="mnd-rates-widget" style="width: 650px; height: 340px; font-size: 12px; ">
    <div class="w-header" style="text-align: center; padding:4px 0;background-color: #336699; color: #FFFFFF;"> <a href="https://www.mortgagenewsdaily.com/mortgage-rates" target="_blank" style="color: #FFFFFF;text-decoration:none;">Today&#x27;s Mortgage Rates</a></div>
    <iframe src="//widgets.mortgagenewsdaily.com/widget/f/rates?t=large&sn=true&c=336699&u=&cbu=&w=648&h=290" width="650" height="290" frameborder="0" scrolling="no" style="border: solid 1px #336699; border-width: 0 1px;box-sizing:border-box;width:650px;height:290px;display:block;"></iframe>
    <div class="w-footer" style="text-align: center; padding:4px 0;background-color: #336699; color: #FFFFFF;">View More <a href="https://www.mortgagenewsdaily.com/mortgage-rates" target="_blank" style="color: #FFFFFF;text-decoration:none;">Refinance Rates</a></div>
</div>
<!---->

<div class="container mt-5"> <!-- Bootstrap container with top margin -->

    <!-- Step 1: Lead form -->
    <h2 class="mb-4">Get Started</h2>
    <form id="leadForm">
        <!-- Name input -->
        <div class="mb-3">
            <label for="leadName" class="form-label">Name</label>
            <input type="text" class="form-control" id="leadName" required />
        </div>

        <!-- Email input -->
        <div class="mb-3">
            <label for="leadEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="leadEmail" required />
        </div>

        <!-- Phone number input -->
        <div class="mb-3">
            <label for="leadPhone" class="form-label">Phone#</label>
            <input type="tel" class="form-control" id="leadPhone" required />
        </div>

        <!-- Submit button to continue to calculator -->
        <button type="submit" class="btn btn-success">Continue to Calculator</button>
    </form>

    <!-- Step 2: Calculator form (hidden by default) -->
    <form id="calculatorForm" class="mt-5 d-none">
        <h3 class="mb-4">Home Affordability Calculator</h3>

        <!-- Display captured info at top of calculator -->
        <div class="alert alert-light border">
            <strong>Name:</strong> <span id="displayName"></span><br />
            <strong>Email:</strong> <span id="displayEmail"></span><br />
            <strong>Phone:</strong> <span id="displayPhone"></span>
        </div>

        <!-- Button to toggle collapsible inputs -->
        <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#calculationInputs">
            Edit Calculation Inputs
        </button>

         <div class="collapse" id="calculationInputs">
            <div class="card card-body">
                <div class="row"> <!-- Bootstrap row -->

                    <!-- Income Amount -->
                    <div class="col-md-4 mb-3">
                        <label for="incomeAmount" class="form-label">Income Amount</label>
                        <input type="number" class="form-control" id="incomeAmount" value="100000" required />
                    </div>

                    <!-- Income Frequency -->
                    <div class="col-md-4 mb-3">
                        <label for="incomeFrequency" class="form-label">Income Frequency</label>
                        <select class="form-select" id="incomeFrequency" required>
                            <option value="" disabled selected>Select frequency</option>
                            <option value="hourly">Hourly</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Bi-weekly</option>
                            <option value="semimonthly">Semi-monthly</option>
                            <option value="monthly">Monthly</option>
                            <option value="annually" selected >Annually</option>
                        </select>
                    </div>
<!-- Credit Score -->
                    <div class="mb-3">
                        <label for="creditScore" class="form-label">Credit Score Range</label>
                        <select class="form-select" id="creditScore" name="creditScore" required>
                            <option value="" disabled selected>Select your credit score range</option>
                            <option value="800-850">800–850 — Exceptional ✅ Best rates, lowest risk</option>
                            <option value="740-799">740–799 — Very Good ✅ Excellent rates, low risk</option>
                            <option value="670-739">670–739 — Good 🟡 Acceptable, higher rates</option>
                            <option selected value="580-669">580–669 — Fair 🔺 Might qualify FHA/VA</option>
                            <option value="below-580">&lt; 580 — Poor 🔴 Very limited loan options</option>
                        </select>
                    </div>


                    <!-- Interest Rate -->
                    <div class="col-md-4 mb-3">
                        <label for="interestRate" class="form-label">Interest Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="interestRate" value="7" required />
                    </div>
                    <!-- Down Payment -->
                    <div class="col-md-4 mb-3">
                        <label for="downPayment" class="form-label">Down Payment</label>
                        <input type="number" step="0.01" class="form-control" id="downPayment"  value="12250" required />
                    </div>

                    <!-- Insurance Rate -->
                    <div class="col-md-4 mb-3">
                        <label for="insurance" class="form-label">Insurance /mo</label>
                        <input type="number" step="0.01" class="form-control" id="insurance" value="160" required />
                        <p>Insurance Estimated @ $1920 /annum</p>
                    </div>
                     <!-- Loan Term -->
                    <div class="col-md-4 mb-3">
                        <label for="term" class="form-label">Loan Term</label>
                        <select class="form-select" id="term" required>
                            <option value="360" selected>30 Years (360 months)</option>
                            <option value="300">25 Years (300 months)</option>
                            <option value="240">20 Years (240 months)</option>
                            <option value="180">15 Years (180 months)</option>
                            <option value="120">10 Years (120 months)</option>
                        </select>
                        <p class="text-muted">Default to 30 years</p>
                    </div>

                    <!-- Property Tax Rate -->
                    <div class="col-md-4 mb-3">
                        <label for="tax" class="form-label">Property Tax /mo</label>
                        <input type="number" step="0.01" class="form-control" id="tax" value="200" required />
                        <p>Insurance Estimated @ $2400 /annum</p>
                    </div>

                </div> <!-- /row -->
            </div> <!-- /card-body -->
        </div> <!-- /collapse -->

        <div>
        <!-- Submit and clear buttons -->
        <button type="submit" class="btn btn-primary">Calculate</button>
        <button type="button" class="btn btn-secondary mt-3" onclick="clearFormData()">Clear Info</button>
</div>
    </form>

    <!-- Results container (initially hidden) -->
    <div id="results" class="mt-4 d-none"></div>

    <!-- Chart for visual display -->
    <canvas id="affordabilityChart" class="my-5 d-none" height="100"></canvas>
</div>

<!-- Load custom JS and Bootstrap bundle -->
<script src="https://unpkg.com/umbrellajs"></script>
<script src="js/calculator.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
