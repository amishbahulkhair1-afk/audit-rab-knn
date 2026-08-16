import { createApp } from "vue";
import Chart from "chart.js/auto";

import "flowbite";

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

// Business Components
import TabelAhspDetail from "./components/ahsp/TabelAhspDetail.vue";
import FormAhsp from "./components/ahsp/FormAhsp.vue";
import UiButton from './components/ui/UiButton.vue'
import UiCard from './components/ui/UiCard.vue'
import UiInput from './components/ui/UiInput.vue'
import UiSelect from './components/ui/UiSelect.vue'
import UiBadge from './components/ui/UiBadge.vue'
import UiDatePicker from './components/ui/UiDatePicker.vue'
import UiDateTime from './components/ui/UiDateTimePicker.vue'
import UiDropdown from './components/ui/UiDropdown.vue'
import UiTextarea from './components/ui/UiTextarea.vue';
import UiModal from './components/ui/UiModal.vue';
import UiPagination from './components/ui/UiPagination.vue';
import DataTable from './components/ui/DataTable.vue'
import TableActions from './components/ui/TableActions.vue'

export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};

window.Chart = Chart;

const app = createApp({
    mounted() {
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
        });
    },
});

// Register Components
app.component("TabelAhspDetail", TabelAhspDetail);
app.component("FormAhsp", FormAhsp);
app.component("UiButton", UiButton);
app.component('UiCard', UiCard);
app.component('UiInput', UiInput);
app.component('UiSelect', UiSelect);
app.component('UiBadge', UiBadge);
app.component('UiDatePicker', UiDatePicker);
app.component('UiDateTimePicker', UiDateTimePicker);
app.component('UiDateTime', UiDateTime);
app.component('UiDropdown', UiDropdown);
app.component('UiTextarea', UiTextarea);
app.component('UiModal', UiModal);
app.component('UiPagination', UiPagination);
app.component('data-table', DataTable)
app.component('table-actions', TableActions)

const appRoot = document.getElementById("app");

if (appRoot) {
    app.mount(appRoot);
}
