<template>


<div class="flex justify-center gap-2">


<a

:href="show"

class="
px-3
py-1.5
rounded-lg
bg-emerald-100
text-emerald-700
text-xs
font-bold
hover:bg-emerald-200
"

>

Detail

</a>




<a

:href="edit"

class="
px-3
py-1.5
rounded-lg
bg-amber-100
text-amber-700
text-xs
font-bold
hover:bg-amber-200
"

>

Edit

</a>


<form

:action="remove"

method="POST"


>


<button

class="
px-3
py-1.5
rounded-lg
bg-rose-100
text-rose-700
text-xs
font-bold
hover:bg-rose-200
"

>

Hapus

</button>


</form>


</div>


</template>



<script setup>


defineProps({

show:String,

edit:String,

remove:String


})


</script>