// Step 1: Capture lead form and save to localStorage
document.getElementById('leadForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent reload

    // Save inputs
    localStorage.setItem('leadName', document.getElementById('leadName').value);
    localStorage.setItem('leadEmail', document.getElementById('leadEmail').value);
    localStorage.setItem('leadPhone', document.getElementById('leadPhone').value);

    // Show calculator form, hide lead form
    document.getElementById('leadForm').classList.add('d-none');
    document.getElementById('calculatorForm').classList.remove('d-none');

    // Populate user info on calculator
    document.getElementById('displayName').textContent = localStorage.getItem('leadName');
    document.getElementById('displayEmail').textContent = localStorage.getItem('leadEmail');
    document.getElementById('displayPhone').textContent = localStorage.getItem('leadPhone');
    console.log(localStorage.getItem('leadName'));


         console.log(localStorage.getItem('leadEmail'));
         console.log(localStorage.getItem('leadPhone'));
         console.log(document.getElementById('displayName'));
         console.log(document.getElementById('displayEmail'));
         console.log(document.getElementById('displayPhone'));

});

// Auto-load user info if page refreshes
window.addEventListener('DOMContentLoaded', function () {
    if (localStorage.getItem('leadName')) {
        document.getElementById('leadForm').classList.add('d-none');
        document.getElementById('calculatorForm').classList.remove('d-none');
        document.getElementById('displayName').textContent = localStorage.getItem('leadName');
        document.getElementById('displayEmail').textContent = localStorage.getItem('leadEmail');
        document.getElementById('displayPhone').textContent = localStorage.getItem('leadPhone');
    }
});

// Clear stored user info
function clearFormData() {
    localStorage.clear();
    location.reload();
}

// Step 2: Handle calculator logic
document.getElementById('calculatorForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get user inputs
    const income = parseFloat(document.getElementById('incomeAmount').value);
    const frequency = document.getElementById('incomeFrequency').value;
    const interestRate = parseFloat(document.getElementById('interestRate').value) / 100;
    const tax = parseFloat(document.getElementById('tax').value);
    const insurance = parseFloat(document.getElementById('insurance').value);
    const term = parseFloat(document.getElementById('term').value);
    const downPayment = parseFloat(document.getElementById('downPayment').value);



    // Normalize to monthly income
    const monthlyIncome = normalizeToMonthlyIncome(income, frequency);

    console.log(monthlyIncome); // Should be 8333.33- @ 100K

calcLoan(monthlyIncome);

        // Calculate loan amount and PI
    function calcLoan(monthlyIncome) {
        const ti = getTotalTI(tax, insurance);
        console.log(ti);

        const monthlyPI  = monthlyIncome
        const  loan = (Math.pow(1 + monthlyRate(interestRate), calculateLoanTerms(term))) / monthlyRate(interestRate);
        console.log("monthly Principal and Interest " + monthlyPI);
        // return { monthlyPI, loan };



        const monthlyRate = calculateLoanTerms(term);

        // Zero interest edge case
        if (monthlyRate === 0) {
            return principal / termMonths;
        }

        const factor = Math.pow(1 + monthlyRate, termMonths);
        return principal * (monthlyRate * factor) / (factor - 1);
    }

    const results = {}
    console.log(results);

    // // Identify best option (highest home price)
    // const bestOption = Object.entries(results).reduce((max, curr) =>
    //     parseFloat(curr[0].price || 0) > parseFloat(max[1].price || 0) ? curr : max
    // );

    // Summary output
    const summary = `
    <div class="mb-4">
      <h4>Affordability Summary</h4>
      <p><strong>Monthly Income:</strong> $${monthlyIncome.toFixed(2)}</p>
      <p><strong>Best Option:</strong> </p>
    </div>`;

    // Per-loan breakdown
    const breakdown = `
    <h5 class="mb-3">Loan Product Breakdown</h5>
    <div class="row">
      ${Object.entries(results).map(([type, data]) => `
        <div class="col-md-4">
          <div class="card mb-3 ${type === bestOption[0] ? 'border-success' : ''}">
            <div class="card-header text-capitalize">${type} Loan ${bdtis[type] * 100}%
<!--              ${type === bestOption[0] ? '<span class="badge bg-success float-end">Best Option</span>' : ''}-->
            </div>
            <div class="card-body">
              <p><strong>Max Payment Amount:</strong> $${data.maxDTI}/mo</p>
              <p><strong>Estimated PI:</strong> $${data.monthlyPI}/mo</p>
              <p><strong>Loan:</strong> $${parseFloat(data.loan).toLocaleString()}</p>
              <p><strong>Down Payment:</strong> $${parseFloat(data.down).toLocaleString()}</p>
              <p><strong>Max Price:</strong> $${parseFloat(data.price).toLocaleString()}</p>
            </div>
          </div>
        </div>`).join('')}
    </div>`;

    // Show results
    document.getElementById('results').innerHTML = summary + breakdown;
    document.getElementById('results').classList.remove('d-none');

    // Chart.js display
    const ctx = document.getElementById('affordabilityChart').getContext('2d');
    document.getElementById('affordabilityChart').classList.remove('d-none');

    const chartData = Object.entries(results).map(([_, d]) => parseFloat(d.price));
    const chartLabels = Object.keys(results).map(k => k.toUpperCase());

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Max Home Price ($)',
                data: chartData,
                backgroundColor: ['#0d6efd', '#198754', '#6f42c1']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: val => `$${val.toLocaleString()}` }
                }
            }
        }
    });

    // Clear info for next run
    // clearFormData();
});


/**
 * Get the combined property tax + insurance rate.
 * @param {number} taxRate - Annual property tax rate as a decimal (e.g., 0.012 for 1.2%).
 * @param {number} insuranceRate - Annual insurance rate as a decimal (e.g., 0.0035 for 0.35%).
 * @returns {number} Combined tax + insurance rate.
 */
function getTotalTI(taxRate, insuranceRate) {
    return taxRate + insuranceRate;
}



// Get down payment percentages per loan type
const downPayment = {
        conventional: 0.03, // 3% down
        fha: 0.035,         // 3.5% down
        va: 0               // 0% down
}


// Get front-end DTI ratios
const fdtis = {
        conventional: 0.28,
        fha: 0.31,
        va: 0.28

}

// Get back-end DTI ratios
const bdtis = {
        conventional: 0.36,
        fha: 0.43,
        va: 0.41
}



function calculateLoanTerms(term){
    const payments = term / 12;
    return payments;
}

function monthlyRate(interestRate){
    const monthlyRate = interestRate / 12;
    return monthlyRate;
}

function calculateLoanTerms(years){
    const term = 360;
    return term;
}



// Convert any income to monthly gross income
function normalizeToMonthlyIncome(income, frequency) {
    switch (frequency) {
        case 'hourly':
            return income * 40 * 52 / 12; // assumes 40 hrs/week, 52 weeks/year
        case 'weekly':
            return income * 52 / 12;
        case 'biweekly':
            return income * 26 / 12;
        case 'semimonthly':
            return income * 2;
        case 'monthly':
            return income;
        case 'annually':
            return income / 12;
        default:
            return 0; // invalid frequency
    }
}

/**
 * Calculate loan results for all loan types.
 * @param {number} monthlyIncome - Borrower's monthly gross income.
 * @param {Object} fdtis - Front-end DTI ratios per loan type.
 * @param {Object} bdtis - Back-end DTI ratios per loan type.
 * @param {Object} downPayments - Down payment % per loan type.
 * @param {Function} calcLoan - Function to calculate PI & loan from max PITI.
 * @returns {Object} Results keyed by loan type.
 */
function calculateLoanOptions(monthlyIncome, fdtis, bdtis) {


    for (const type in bdtis) {
        const minDTI = monthlyIncome * fdtis[type];
        const maxDTI = monthlyIncome * bdtis[type];

        const { monthlyPI, loan } = calcLoan(maxDTI);
        const down = loan * downPayments[type];
        const price = loan + down;

        results[type] = {
            maxDTI: maxDTI.toFixed(2),
            monthlyPI: monthlyPI.toFixed(2),
            loan: loan.toFixed(0),
            down: down.toFixed(0),
            price: price.toFixed(0)
        };
    }

    return results;
}
