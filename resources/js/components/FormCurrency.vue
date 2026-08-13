<script setup>

defineProps({

    name:String,

    label:String,

    value:[String,Number],

    required:Boolean

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
">

{{ label }}

<span 
v-if="required"
class="text-rose-500"
>
*
</span>

</label>




<div class="relative">


<span
class="
absolute
left-3
top-2.5
text-sm
font-semibold
text-slate-400
"
>
Rp
</span>



<input

type="number"

:name="name"

:value="value"

:required="required"

class="
w-full
rounded-lg
border-slate-300
text-sm
pl-10
focus:border-indigo-500
focus:ring-indigo-200
"

/>



</div>


</div>

</template>