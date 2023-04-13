import { capitalize, makeRequest } from "../common.js";

$(() => {
    const chefColors = Array.from({ length: 20 }).map((_, i) => `#${Math.floor(Math.random() * 16777215).toString(16)}`);

    chartNumberRecipesByChef(chefColors);

    chartNumberLikesPerRecipeByChef(chefColors);

    chartNumberRecipesContainigIngredients();
});

const chartNumberRecipesByChef = async (chefColors) => {

    const chefs = await getAllChefs();
    const chefsWithoutAdmin = chefs.filter((chef) => chef.role === "USER");

    const xValues = Array.from({ length: chefsWithoutAdmin.length }).map((_, i) => capitalize(chefsWithoutAdmin[i].name));

    let yValues = [];
    for (const chef of chefsWithoutAdmin) {
        const numberRecipes = await getNumberRecipesByChef(chef.id);
        yValues.push(numberRecipes);
    }

    new Chart("chartNumberRecipesByChef", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: chefColors,
                data: yValues
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Number of recipes per chef"
            }
        }
    });
}

const chartNumberRecipesContainigIngredients = async () => {
    const xValues = await getAllIngredients();

    let yValues = [];
    for (const ingredient of xValues) {
        const numberRecipes = await getNumberRecipesByIngredient(ingredient);
        yValues.push(numberRecipes);
    }

    new Chart("chartNumberRecipesContainigIngredients", {
        type: "line",
        data: {
            labels: xValues.map((ingredient) => capitalize(ingredient)),
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "#645cff",
                borderColor: "#645cff4d",
                data: yValues,
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Number of recipes per ingredient"
            }
        }
    });
}

const chartNumberLikesPerRecipeByChef = async (chefColors) => {
    const chefs = await getAllChefs();
    const chefsWithoutAdmin = chefs.filter((chef) => chef.role === "USER");

    const xValues = Array.from({ length: chefsWithoutAdmin.length }).map((_, i) => capitalize(chefsWithoutAdmin[i].name));

    let yValues = [];
    for (const chef of chefsWithoutAdmin) {
        const numberRecipes = await getNumberLikesByChef(chef.id);
        yValues.push(numberRecipes);
    }

    new Chart("chartNumberLikesPerRecipeByChef", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: chefColors,
                data: yValues
            }]
        },
        options: {
            legend: { display: true },
            title: {
                display: true,
                text: "Number of Like per chef"
            }
        }
    });
}

const getAllChefs = async () => {
    const ris = await Promise.resolve(
        makeRequest({
            type: "GET",
            url: "./api/chefs/getAll.php",
        })
    );
    return JSON.parse(ris.chefs);
}

const getNumberRecipesByChef = async (chef_id) => {
    const ris = await Promise.resolve(
        makeRequest({
            type: "GET",
            url: `./api/chefs/getNumberRecipes.php?id=${chef_id}`,
        })
    );
    return JSON.parse(ris.count);
}

const getAllIngredients = async () => {
    const ris = await Promise.resolve(
        makeRequest({
            type: "GET",
            url: "./api/ingredients/getAll.php",
        })
    );
    return JSON.parse(ris.ingredients);
}

const getNumberRecipesByIngredient = async (ingredient_id) => {
    const ris = await Promise.resolve(
        makeRequest({
            type: "GET",
            url: `./api/ingredients/getNumberRecipes.php?id=${ingredient_id}`,
        })
    );
    return JSON.parse(ris.count);
}

const getNumberLikesByChef = async (chef_id) => {
    const ris = await Promise.resolve(
        makeRequest({
            type: "GET",
            url: `./api/chefs/getNumberLikes.php?id=${chef_id}`,
        })
    );
    return JSON.parse(ris.count);
}