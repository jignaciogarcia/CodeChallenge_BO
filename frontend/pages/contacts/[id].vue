<template>
    <div class="bg-slate-100 h-full min-h-screen w-screen">
        <header class="h-14 md:bg-fuchsia-100 flex items-center">
            <button class="text-slate-500 ml-5" @click="goBack()">&lt Back</button>
        </header>
        <div class="hidden md:pt-10 md:px-14 md:block">
            <div class="bg-gray-300 h-48 w-full rounded-xl flex justify-end items-end">
                <NuxtLink :to="`/contacts/create-update/${contact.id}`">
                    <button class="button px-8 mr-5 mb-5 mt-7">
                        EDIT
                    </button>
                </NuxtLink>
            </div>
        </div>
        <div class="md:flex md:flex-col md:items-center">
            <div class="flex flex-col items-center rounded-2xl py-2 w-auto mx-4 bg-fuchsia-100 
                md:rounded-none md:py-0 md:w-fit md:mx-0 md:bg-inherit md:relative md:bottom-24 ">
                <img :src="`${contact.profilePictureUrl ? contact.profilePictureUrl : DEFAULT_PROFILE_PICTURE}`"
                    class="rounded-full w-20 h-20 md:h-40 md:w-40 md:border-2 md:border-black">
                <p class="font-sans font-bold text-lg mt-3 md:mt-8">{{ contact.name }}</p>
                <p class="text-slate-500">{{ contact.title }}</p>
            </div>
            <div class="mt-5 ml-4 md:block md:relative md:bottom-24 md: md:mt-10">
                <div class="grid grid-cols-1 gap-x-14 gap-y-5 md:grid-cols-2">
                    <div>
                        <p class="font-bold font-sans mb-2">Address</p>
                        <p class="text-slate-500">{{ contact.address }}</p>
                    </div>
                    <div>
                        <p class="font-bold font-sans mb-2">Email</p>
                        <p class="text-slate-500">{{ contact.email }}</p>
                    </div>
                    <div>
                        <p class="font-bold font-sans mb-2">Phone</p>
                        <p class="text-slate-500">{{ contact.cellphoneNumber }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center h-auto md:hidden">
            <NuxtLink :to="`/contacts/create-update/${contact.id}`">
                <button class="button px-20 mt-7">
                    EDIT
                </button>
            </NuxtLink>
        </div>
    </div>
</template>


<script setup>
import { useContactsStore } from '#imports';
import { DEFAULT_PROFILE_PICTURE } from '~/constants';

const { id } = useRoute().params;
const contactsStore = useContactsStore();
var contact;

onBeforeMount(() => {
    contact = contactsStore.getContactById(id);
});
</script>

<script>
export default {
    methods: {
        goBack() {
            this.$router.go(-1);
        }
    },
    data() {
        return {DEFAULT_PROFILE_PICTURE}
    }
}
</script>