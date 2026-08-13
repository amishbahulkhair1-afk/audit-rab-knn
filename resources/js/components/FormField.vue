<script setup>

const props = defineProps({

    field: {
        type: Object,
        required: true
    },

    modelValue: {
        required: false
    }

})


const emit = defineEmits([
    'update:modelValue'
])


const updateValue = (event) => {

    emit(
        'update:modelValue',
        event.target.value
    )

}


</script>



<template>


    <div>


        <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

            {{ field.label }}


            <span v-if="field.required" class="text-rose-500">
                *
            </span>


        </label>





        <!-- TEXT / NUMBER -->

        <input v-if="
            field.type === 'text' ||
            field.type === 'number'
        " :value="modelValue" @input="updateValue" :name="field.name" :type="field.type" :placeholder="field.placeholder"
            class="
w-full rounded-lg 
border-slate-300
text-sm
focus:border-indigo-500
focus:ring-indigo-200
" />







        <!-- TEXTAREA -->

        <textarea v-else-if="field.type === 'textarea'" :value="modelValue" @input="updateValue" :name="field.name"
            rows="4" :placeholder="field.placeholder" class="
w-full rounded-lg 
border-slate-300
text-sm
focus:border-indigo-500
focus:ring-indigo-200
"></textarea>








        <!-- CURRENCY -->


        <div v-else-if="field.type === 'currency'" class="relative">


            <span class="
absolute 
left-3 
top-2.5
text-sm
font-semibold
text-slate-400
">
                Rp
            </span>



            <input :value="modelValue" @input="updateValue" :name="field.name" type="number" class="
w-full rounded-lg 
border-slate-300
text-sm
pl-10
focus:border-indigo-500
focus:ring-indigo-200
" />


        </div>





    </div>


</template>