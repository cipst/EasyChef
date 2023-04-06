import { capitalize, makeRequest } from "../common.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/cooking_methods/getAll.php",
        data: {},
        onSuccess: (response) => {
            for (const [index, method] of JSON.parse(response.methods).entries()) {
                $(".tags-list").append(`<a href="recipes_by_cooking_method.php?method=${method.toLowerCase()}">${method}</a>`);
                $("select.form-input").append(`<option key=${index} value=${method}>${method}</option>`);

                // Control Panel Admin - Cooking Methods
                $("#cooking-method-table").append(`<tr>
                    <th scope="row">${capitalize(method)}</th>
                    <td>
                        <button class="btn-action danger" type="button"><i
                                class="fa-solid fa-trash-can fa-2xl"></i></button>
                        <button class="btn-action success" type="button"><i
                                class="fa-solid fa-pen fa-2xl"></i></button>
                    </td>
                </tr>`);
            }
            $("#cooking-method-table").append(`<tr>
                    <th scope="row">
                        <input type="text" class="form-input" placeholder="New Cooking Method" style="height:100%"/>
                    </th>
                    <td>
                        <button class="btn-action-outline success" type="button"><i
                                class="fa-solid fa-check fa-2xl"></i></button>
                    </td>
                </tr>`);
        }
    });
});