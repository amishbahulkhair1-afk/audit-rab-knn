<script setup>

defineProps({

    name:{
        type:String,
        required:true
    },

    label:{
        type:String,
        required:true
    },

    type:{
        type:String,
        default:'text'
    },

    value:{
        default:''
    },

    placeholder:{
        type:String,
        default:''
    },

    required:{
        type:Boolean,
        default:false
    }

})


</script>


<template>

<div>

    <label 
        class="
        block 
        text-xs 
        font-bold 
        uppercase 
        tracking-wide 
        text-slate-700 
        mb-2
        "
    >

        {{ label }}

        <span 
            v-if="required"
            class="text-rose-500"
        >
            *
        </span>

    </label>



    <input

        :name="name"

        :type="type"

        :value="value"

        :placeholder="placeholder"

        :required="required"

        class="
        w-full
        rounded-lg
        border-slate-300
        text-sm
        focus:border-indigo-500
        focus:ring-indigo-200
        "

    />


</div>

</template>