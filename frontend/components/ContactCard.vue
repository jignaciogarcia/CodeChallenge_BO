<template>
    <div class="rounded-2xl border-2 border-fuchsia-100 w-72">
        <div class="flex p-4">
            <img :src="contact.profilePictureUrl" alt="Contact profile picture" class="rounded-full h-16 w-16">
            <div class="h-16 w-max truncate px-3 flex items-center">
                <div>
                    <p class="font-sans font-bold text-lg">{{ contact.name }}</p>
                    <p class="font-sans text-sm text-slate-500">{{ contact.email }}</p>
                </div>
            </div>
            <img src="../assets/arrowRight.png" class="w-6 h-6 mt-3">
        </div>
    </div>
</template>


<script setup>

    const { contact } = defineProps(['contact']);

</script>