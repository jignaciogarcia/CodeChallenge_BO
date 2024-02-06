<template>
    <div class="lg:rounded-2xl lg:border-2 lg:border-fuchsia-100 w-auto lg:bg-white">
        <div class="flex p-4">
            <img :src="contact.profilePictureUrl ? contact.profilePictureUrl : DEFAULT_PROFILE_PICTURE" 
                alt="Contact profile picture" class="rounded-full h-16 w-16">
            <div class="h-16 w-max truncate px-3 flex items-center">
                <div>
                    <p class="font-sans font-bold text-lg">{{ contact.name }}</p>
                    <p class="font-sans text-sm text-slate-500">{{ contact.title }}</p>
                </div>
            </div>
            <div class="ml-auto">
                <NuxtLink :to="`/contacts/${contact.id}`">
                    <img src="../assets/arrowRight.png" class="w-6 h-6 mt-3">
                </NuxtLink>
            </div>
            
        </div>
    </div>
</template>


<script setup>
import { DEFAULT_PROFILE_PICTURE } from '~/constants';

const { contact } = defineProps(['contact']);

</script>