<template>
    <div class="bg-slate-100 h-screen w-screen">
        <header class="h-14 md:bg-fuchsia-100 flex items-center">
            <button class="text-slate-500 ml-5" @click="goBack()">&lt Back</button>
        </header>
        <div class="hidden md:pt-10 md:px-14 md:block">
            <div class="bg-gray-300 h-48 w-full rounded-xl flex justify-end items-end">
                <NuxtLink :to="`/contacts/create-update/${contact.id}`">
                    <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-8 active:bg-violet-700 mr-5 mb-5">
                        EDIT
                    </button>
                </NuxtLink>
            </div>
        </div>
        <div class="md:flex md:flex-col md:items-center">
            <div class="flex flex-col items-center rounded-2xl py-2 w-auto mx-4 bg-fuchsia-100 
                md:rounded-none md:py-0 md:w-fit md:mx-0 md:bg-inherit md:relative md:bottom-24 ">
                <img :src="`${contact.profilePictureUrl}`"
                    class="rounded-full w-20 h-20 md:h-40 md:w-40 md:border-2 md:border-black">
                <p class="font-sans font-bold text-lg mt-3 md:mt-8">{{ contact.name }}</p>
                <p class="text-slate-500">Title?</p>
                <div class="hidden md:block mt-12">
                    <div class="flex">
                        <div>
                            <p class="font-bold font-sans mb-2">Address</p>
                            <p class="text-slate-500">{{ contact.address }}</p>
                        </div>
                        <div class="ml-10">
                            <p class="font-bold font-sans mb-2">Email</p>
                            <p class="text-slate-500">{{ contact.email }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="font-bold font-sans mb-2">Phone</p>
                        <p class="text-slate-500">{{ contact.cellphoneNumber }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 px-4 md:hidden">
            <p class="font-bold font-sans mb-2">Address</p>
            <p class="text-slate-500">{{ contact.address }}</p>
            <p class="font-bold font-sans mb-2 mt-5">Email</p>
            <p class="text-slate-500">{{ contact.email }}</p>
            <p class="font-bold font-sans mb-2 mt-5">Phone</p>
            <p class="text-slate-500">{{ contact.cellphoneNumber }}</p>
        </div>
        <div class="flex justify-center items-end md:hidden">
            <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-20 active:bg-violet-700">EDIT</button>
        </div>
    </div>
</template>


<script setup>
import { useContactsStore } from '#imports';

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
    }
}
</script>