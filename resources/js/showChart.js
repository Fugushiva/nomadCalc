import { Chart } from "chart.js/auto";

// URL to get data
const expenseURL = "/api/expense/week"; // Dépenses de la semaine avec taux de conversion
const categoryURL = "/api/categories"; // Catégories des dépenses

let expenseCategories = [];

/**
 * Retrieves the expenses of the week and the corresponding categories with conversion in euro €
 * @returns {Promise<void>} - The expenses of the week with the conversion in euro €
 * 
 */
async function getCategoryId() {
    const response = await fetch(expenseURL, {
        method: "get",
    })
        .then((res) => res.json())
        .catch((error) =>
            console.error("Erreur lors de la récupération des dépenses.")
        )
        .then((res) => {
            if (res) {
                expenseCategories = res; // Dépenses récupérées
            }
        })
        .then(() => {
            getCategories(); // Afficher les catégories dans l'interface
        })
        .then(() => {
            createChart(expenseCategories); // Créer le graphique
        });
}

/**
 * Retrieves the categories of the expenses
 * @returns {Promise<void>} - The categories of the expenses
 */
async function getCategories() {
    const response = await fetch(categoryURL, {
        method: "get",
    })
        .then((res) => res.json())
        .catch((error) =>
            console.error("Erreur lors de la récupération des catégories.")
        );

    if (response) {
        response.forEach((category) => {
            if (
                expenseCategories.some(
                    (expense) => expense.category_id === category.id
                )
            ) {
           
            }
        });
    }
}

getCategoryId();

/**
 * Creates the chart with the expenses
 * @param {Array} expenses - The expenses of the week
 * @returns {Promise<void>} - The chart with the expenses
 */
async function createChart(expenses) {
    // group expenses by category
    const groupedExpenses = expenses.reduce((acc, expense) => {
        const categoryName = expense.category.name; 
        const amountInEuro = parseFloat(expense.converted_amount); // amount in euro

        //  initialise the category if it does not exist
        if (!acc[categoryName]) {
            acc[categoryName] = 0;
        }
        acc[categoryName] += amountInEuro; // Additionner les montants
        return acc;
    }, {});

    // Extract the labels and data to create the chart
    const labels = Object.keys(groupedExpenses);
    const data = Object.values(groupedExpenses);
   

    // Create the chart
    new Chart(document.getElementById("chartCanva"), {
        type: "doughnut",
        data: {
            labels: labels, // name of the categories
            datasets: [
                {
                    label: "Dépenses en euros (€)",
                    data: data, // amount in euro for each category
                },
            ],
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        // Display the amount in euro when hovering over the chart
                        label: function (tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw.toFixed(
                                2
                            )} €`;
                        },
                    },
                },
            },
        },
    });
}
