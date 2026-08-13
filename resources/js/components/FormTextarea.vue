<script setup>

defineProps({

    name:String,

    label:String,

    value:String,

    placeholder:String

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

{{label}}

</label>



<textarea

:name="name"

:placeholder="placeholder"

rows="4"

class="
w-full
rounded-lg
border-slate-300
text-sm
focus:border-indigo-500
focus:ring-indigo-200
"

>{{value}}</textarea>



</div>


</template>