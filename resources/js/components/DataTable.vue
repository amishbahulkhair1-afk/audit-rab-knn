<script setup>

import { ref, computed } from 'vue';


const props = defineProps({

    dataAwal: {
        type: [Array, Object],
        required: true
    },


    columns: {
        type: Array,
        required: true
    },


    routeName: {
        type: String,
        default: ''
    }

});


// SEARCH
const searchQuery = ref('');


// CSRF TOKEN
const csrf = document.querySelector(
    'meta[name="csrf-token"]'
)?.content;



// HANDLE PAGINATION LARAVEL
const dataList = computed(() => {


    // Jika array biasa
    if (Array.isArray(props.dataAwal)) {

        return props.dataAwal;

    }


    // Jika Laravel paginate()
    if (props.dataAwal.data) {

        return props.dataAwal.data;

    }


    return [];

});




// FILTER SEARCH
const filteredData = computed(() => {


    return dataList.value.filter(item => {


        const search = searchQuery.value
            .toLowerCase();


        if (search === '') {

            return true;

        }


        return Object.values(item)
            .join(' ')
            .toLowerCase()
            .includes(search);


    });


});





// FORMAT DATA
const formatValue = (value, key) => {


    if (
        key.includes('harga') ||
        key.includes('upah') ||
        key.includes('biaya')
    ) {

        return new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }
        ).format(value);

    }



    return value ?? '-';


};





// BADGE
const badgeClass = (value) => {


    switch (value) {


        case 'material':
            return 'bg-blue-100 text-blue-700';


        case 'labor':
            return 'bg-amber-100 text-amber-700';


        case 'equipment':
            return 'bg-purple-100 text-purple-700';



        default:
            return 'bg-slate-100 text-slate-700';


    }


};




</script>



<template>



    <div>


        <!-- SEARCH -->

        <div class="mb-5">

            <input v-model="searchQuery" type="text" placeholder="Cari data..."
                class="w-full rounded-lg border px-4 py-2">

        </div>





        <!-- TABLE -->

        <div class="bg-white rounded-xl shadow border overflow-hidden">


            <table class="w-full">


                <thead class="bg-slate-50">


                    <tr>


                        <th v-for="column in columns" :key="column.key"
                            class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">

                            {{ column.label }}


                        </th>


                    </tr>


                </thead>





                <tbody>

                    <tr v-for="item in filteredData" :key="item.id" class="border-t hover:bg-slate-50">


                        <td v-for="column in columns" :key="column.key" class="px-6 py-4 text-sm">


                            <!-- JIKA KOLOM AKSI -->
                            <template v-if="column.type === 'action'">


                                <TableAction :show="`/${routeName}/${item.id}`" :edit="`/${routeName}/${item.id}/edit`"
                                    :remove="`/${routeName}/${item.id}`" />


                            </template>



                            <!-- JIKA KOLOM BIASA -->
                            <template v-else>


                                <span v-if="column.type === 'badge'" :class="badgeClass(item[column.key])"
                                    class="px-3 py-1 rounded-full text-xs">

                                    {{ item[column.key] }}

                                </span>


                                <span v-else>

                                    {{ formatValue(item[column.key], column.key) }}

                                </span>


                            </template>



                        </td>


                    </tr>


                </tbody>



            </table>



        </div>



    </div>



</template>