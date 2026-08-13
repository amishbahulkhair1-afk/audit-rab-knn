<script setup>

defineProps({

text:String,

color:{
type:String,
default:'gray'
}

});


</script>



<template>

<span

class="
px-3
py-1
rounded-full
text-xs
font-semibold
"

:class="{

'bg-blue-100 text-blue-700':color==='blue',

'bg-amber-100 text-amber-700':color==='amber',

'bg-purple-100 text-purple-700':color==='purple',

'bg-emerald-100 text-emerald-700':color==='green',

'bg-slate-100 text-slate-700':color==='gray'


}"

>

{{text}}

</span>


</template>