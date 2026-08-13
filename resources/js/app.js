import { createApp } from "vue";
import Chart from "chart.js/auto";

import TabelAhspDetail from "./components/TabelAhspDetail.vue";
import FormAhsp from "./components/FormAhsp.vue";
import DataTable from "./components/DataTable.vue";
import Badge from "./components/Badge.vue";
import TableAction from "./components/TableAction.vue";
import BaseForm from "./components/BaseForm.vue";
import FormField from "./components/FormField.vue";
import FormInput from "./components/FormInput.vue";
import FormCurrency from "./components/FormCurrency.vue";
import FormTextarea from "./components/FormTextarea.vue";

window.Chart = Chart;

const app = createApp({
    data() {
        return {
            sidebarOpen: false,
            sidebarMini: false,
            userMenu: false,
        };
    },

    methods: {
        toggleMini() {
            this.sidebarMini = !this.sidebarMini;
        },

        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },

        closeSidebar() {
            this.sidebarOpen = false;
        },

        closeUserMenu() {
            this.userMenu = false;
        },

        toggleMobileMenu() {
            this.sidebarOpen = !this.sidebarOpen;
        },
    },
});

app.component("tabel-ahsp-detail", TabelAhspDetail);

app.component("form-ahsp", FormAhsp);

app.component("DataTable", DataTable);

app.component("Badge", Badge);

app.component("TableAction", TableAction);

app.component("BaseForm", BaseForm);

app.component("FormField", FormField);

app.component("FormInput", FormInput);

app.component("FormCurrency", FormCurrency);

app.component("FormTextarea", FormTextarea);

app.mount("#app");
