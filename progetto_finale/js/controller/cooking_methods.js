import { Alert } from "../alert.js";
import { capitalize, isValid, makeRequest } from "../common.js";
import { ALERT_TYPE } from "../constants.js";

$(() => {
    getAllCookingMethods();
});

const getAllCookingMethods = () => {
    makeRequest({
        type: "GET",
        url: "./api/cooking_methods/getAll.php",
        data: {},
        onSuccess: (response) => {
            for (const [index, method] of JSON.parse(response.methods).entries()) {
                $(".tags-list").append(`<a href="recipes_by_cooking_method.php?method=${method.toLowerCase()}">${method}</a>`);
                $("select.form-input").append(`<option key=${index} value=${method}>${method}</option>`);

                // Control Panel Admin - Cooking Methods
                $("#cooking-method-table").append(`<tr id="cooking-method-${method}">
                    <th scope="row">${capitalize(method)}</th>
                    <td>
                        <button id="delete-cooking-method-${method}" class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);

                $(`#delete-cooking-method-${method}`).click(() => {
                    deleteCookingMethod(method);
                });
            }

            $("#cooking-method-table").append(lastInsertRow);

            $("#addCookingMethod").click((event) => {
                event.preventDefault();

                const cookingMethodName = $("#cookingMethodName").val().trim();
                if (isValid(cookingMethodName, "#cookingMethodName", "Please enter a cooking method!"))
                    createCookingMethod(cookingMethodName);
            });
        }
    });
};

const createCookingMethod = (method) => {
    makeRequest({
        type: "POST",
        url: "./api/cooking_methods/create.php",
        data: { name: method.toLowerCase() },
        onSuccess: (response) => {
            new Alert(ALERT_TYPE.SUCCESS, response.ok);
            $("#cooking-method-last-insert-row").remove();

            $("#cooking-method-table").append(`<tr id="cooking-method-${method}">
                    <th scope="row">${capitalize(method)}</th>
                    <td>
                        <button id="delete-cooking-method-${method}" class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);

            $("#cooking-method-table").append(lastInsertRow);
        },
        onError: (response) => {
            console.log(response);
            let error;
            if (response.responseJSON.error.toLowerCase().includes("duplicate entry")) {
                error = "Ingredient already in the list";
            } else {
                error = "Error adding the ingredient";
            }

            new Alert(ALERT_TYPE.ERROR, "Error", error);
        }
    })
}

const deleteCookingMethod = (method) => {
    new Alert(ALERT_TYPE.WARNING, "Are you sure?", "Are you sure you want to delete this cooking method and ALL the recipes containing it?", () => {

        makeRequest({
            type: "POST",
            url: "./api/cooking_methods/delete.php",
            data: { name: method },
            onSuccess: (response) => {
                new Alert(ALERT_TYPE.SUCCESS, response.ok);
                $(`#cooking-method-table #cooking-method-${method}`).remove();
            },
            onError: (response) => {
                new Alert(ALERT_TYPE.ERROR, "Error", "Error deleting the cooking method");
            }
        });
    });
}

const lastInsertRow = `<tr id="cooking-method-last-insert-row">
    <th scope="row">
        <input id="cookingMethodName" type="text" class="form-input" placeholder="New Cooking Method" style="height:100%"/>
        <label id="add-cooking-method-error" class="label-error" for="cookingMethodName"></label>
    </th>
    <td>
        <button id="addCookingMethod" class="btn-action-outline success" type="button"><i
                class="fa-solid fa-add fa-2xl"></i></button>
    </td>
</tr>`;