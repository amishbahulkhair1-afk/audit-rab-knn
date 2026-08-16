<template>
    <div class="glass-surface rounded-[28px] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-slate-700">

                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <slot name="head" />
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    <slot />
                </tbody>

            </table>
        </div>
    </div>
</template>