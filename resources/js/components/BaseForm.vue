<script setup>

import { reactive, computed } from 'vue'
import FormField from './FormField.vue'



const props = defineProps({

    title: {
        type: String,
        default: 'Form'
    },


    description: {
        type: String,
        default: ''
    },


    fields: {
        type: Array,
        required: true
    },


    action: {
        type: String,
        required: true
    },


    method: {
        type: String,
        default: 'POST'
    },


    oldData: {
        type: Object,
        default: () => ({})
    },


    errors: {
        type: Object,
        default: () => ({})
    },

    headerBadge: {
        type: String,
        default: ''
    },

    submitText: {
        type: String,
        default: 'Simpan'
    },

    cancelUrl: {
        type: String,
        default: ''
    }

})





const form = reactive({})


// membuat state form otomatis dari fields

props.fields.forEach(field => {


    form[field.name] =
        props.oldData[field.name] ?? ''


})





const httpMethod = computed(() => {

    if (props.method.toUpperCase() !== 'POST') {

        return props.method.toUpperCase()

    }


    return null

})






const csrf = document.querySelector(
    'meta[name="csrf-token"]'
)?.content





</script>






<template>


    <div class="
bg-white 
shadow-sm 
rounded-xl 
border 
border-slate-100 
overflow-hidden
">



        <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    {{ title }}
                </h3>

                <p v-if="description" class="text-sm text-slate-500 mt-1">
                    {{ description }}
                </p>
            </div>

            <div v-if="headerBadge">
                <span class="inline-flex items-center px-3 py-1 rounded-lg
                   bg-indigo-50 text-indigo-700 border border-indigo-100
                   text-xs font-semibold">
                    {{ headerBadge }}
                </span>
            </div>
        </div>

        <!-- FORM -->

        <div class="
p-6 
md:p-8
">


            <form :id="'base-form'" :action="action" method="POST" class="space-y-6">



                <!-- CSRF -->

                <input type="hidden" name="_token" :value="csrf" />

                <!-- METHOD PUT/PATCH -->

                <input v-if="httpMethod" type="hidden" name="_method" :value="httpMethod" />

                <!-- FIELD LOOP -->


                <div v-for="field in fields" :key="field.name">



                    <FormField :field="field" v-model="form[field.name]" />





                    <p v-if="errors[field.name]" class="
text-xs 
text-rose-600 
mt-1
">

                        {{ errors[field.name][0] }}


                    </p>



                </div>

                <!-- BUTTON -->


                <div class="
pt-6
border-t
border-slate-100
flex
justify-end
gap-3
">



                    <a href="javascript:history.back()" class="
px-5
py-2.5
bg-slate-100
hover:bg-slate-200
text-slate-700
text-sm
font-medium
rounded-lg
transition
">

                        Batal

                    </a>






                    <button type="submit" class="
px-5
py-2.5
bg-indigo-600
hover:bg-indigo-700
text-white
text-sm
font-semibold
rounded-lg
shadow-sm
transition
">


                        Simpan


                    </button>




                </div>






            </form>



        </div>



    </div>


</template>