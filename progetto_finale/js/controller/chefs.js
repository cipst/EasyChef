import { Alert } from "../alert.js";
import { createChefEntries, makeRequest } from "../common.js";
import { ALERT_TYPE } from "../constants.js";

$(() => {
    makeRequest({
        type: "GET",
        url: "./api/chefs/getAll.php",
        onSuccess: (response) => {
            const chefs = JSON.parse(response.chefs);
            console.log(chefs);
            // Control Panel Admin - Chefs
            createChefEntries(chefs.entries(), deleteChef);
        },
        onError: (response) => {
            console.log(response.responseJSON);
            Alert.init(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
        }
    });
});

const deleteChef = (chef_id) => {
    Alert.init(ALERT_TYPE.WARNING, "Are you sure?", "Are you sure you want to delete this chef and ALL of his recipes?", () => {
        makeRequest({
            type: "POST",
            url: "./api/chefs/delete.php",
            data: { id: chef_id },
            onSuccess: (response) => {
                Alert.init(ALERT_TYPE.SUCCESS, "Chef deleted", response.message);
                $(`#chef-table #chef-${chef_id}`).remove();
            },
            onError: (response) => {
                Alert.init(ALERT_TYPE.ERROR, "An error occurred", response.responseJSON.error);
            }
        });
    });
}