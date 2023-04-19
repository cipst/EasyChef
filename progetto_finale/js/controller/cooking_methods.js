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
                    <th scope="row">
                        <input type="text" class="form-control" id="cooking-method-${method}-name-input" value="${capitalize(method)}">
                        <label id="cooking-method-${method}-error" class="label-error" for="cooking-method-${method}-name-input"></label>
                        <span id="cooking-method-${method}-name">${capitalize(method)}</span>
                    </th>
                    <td>
                        <button id="delete-cooking-method-${method}" class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button id="update-cooking-method-${method}" class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);

                $(`#delete-cooking-method-${method}`).click(() => {
                    deleteCookingMethod(method);
                });

                $(`#update-cooking-method-${method}`).click(() => {
                    $(`#cooking-method-${method}-name-input`).show().focus();
                    $(`#cooking-method-${method}-name`).hide();

                    $(`#cooking-method-${method}-name-input`).keypress((event) => {
                        if (event.key === "Enter") {
                            event.preventDefault();
                            const newMethod = $(`#cooking-method-${method}-name-input`).val().trim().toLowerCase();

                            if (newMethod === method) {
                                Alert.init(ALERT_TYPE.ERROR, "Error", "New ingredient name is the same as the old one");
                                return;
                            }

                            if (isValid(newMethod, `#cooking-method-${method}-name-input`, "Please enter a cooking method!")) {
                                updateCookingMethod(method, newMethod);
                                $(`#cooking-method-${method}-name-input`).hide();
                                $(`#cooking-method-${method}-error`).hide();
                                $(`#cooking-method-${method}-name`).show();
                            }
                        }
                    });

                    $(`#cooking-method-${method}-name-input`).keyup((event) => {
                        if (event.key === "Escape") {
                            event.preventDefault();
                            $(`#cooking-method-${method}-name-input`).hide();
                            $(`#cooking-method-${method}-error`).hide();
                            $(`#cooking-method-${method}-name`).show();
                        }
                    });
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
            Alert.init(ALERT_TYPE.SUCCESS, response.ok);
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

            Alert.init(ALERT_TYPE.ERROR, "Error", error);
        }
    })
}

const deleteCookingMethod = (method) => {
    Alert.init(ALERT_TYPE.WARNING, "Are you sure?", "Are you sure you want to delete this cooking method and ALL the recipes containing it?", () => {

        makeRequest({
            type: "POST",
            url: "./api/cooking_methods/delete.php",
            data: { name: method },
            onSuccess: (response) => {
                Alert.init(ALERT_TYPE.SUCCESS, response.ok);
                $(`#cooking-method-table #cooking-method-${method}`).remove();
            },
            onError: (response) => {
                Alert.init(ALERT_TYPE.ERROR, "Error", "Error deleting the cooking method");
            }
        });
    });
}

const updateCookingMethod = (oldMethod, newMethod) => {
    makeRequest({
        type: "POST",
        url: "./api/cooking_methods/update.php",
        data: { oldCookingMethod: oldMethod, newCookingMethod: newMethod },
        onSuccess: (response) => {
            Alert.init(ALERT_TYPE.SUCCESS, response.ok);
            $(`#cooking-method-${oldMethod}-name`).text(capitalize(newMethod));
        },
        onError: (response) => {
            Alert.init(ALERT_TYPE.ERROR, "Error", "Error updating the cooking method");
        }
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