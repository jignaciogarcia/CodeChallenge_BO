<template>
    <div class="bg-slate-50 min-h-screen h-full w-full">
        <header class="md:h-14 bg-fuchsia-100 block"></header>
        <div class="pt-14 px-10 w-full">
            <h1 class="font-sans font-bold text-3xl">Contacts</h1>
            <div class="mt-5 rounded p-1 shadow-x1 w-full flex bg-white">
                <img src="../../assets/searchIcon.png" alt="Search icon" class="h-5 w-5">
                <input type="text" placeholder="Search contacts" class="w-full pl-3"
                    v-model="contactsStore.searchContactsValue">
            </div>
        </div>
        <div class="flex justify-center">
            <p id="errorText" hidden="true" class="errorMessage"></p>
        </div>
        <div v-if="contactsStore.userContacts.length > 0"
            class="mt-16 lg:mx-20 lg:grid lg:grid-cols-3 lg:gap-y-4 lg:gap-x-5 xl:gap-x-16 xl:mx-40">
            <div v-for="(contact, index) in contactsStore.filteredContacts" :key="index" :class="{
                'bg-white': index % 2 == 0,
                'lg:bg-slate-100': index % 2 == 0
            }">
                <ContactCard :contact="contact" />
            </div>
        </div>
        <div v-else class="flex flex-col items-center justify-center mt-10">
            <img src="../../assets/noContactsIcon.PNG" alt="No contacts icon" class="h-52 w-52 mb-5">
            <p class="font-sans font-bold text-xl text-sky-900 w-52 text-center">Add contacts to your database</p>
        </div>
        <div class="flex justify-end mt-3 md:hidden">
            <NuxtLink :to="`/contacts/create-update/new`">
                <button class="rounded-full bg-violet-500 ml-auto active:bg-violet-700 h-12 w-12 p-1 flex 
                    justify-center items-center text-white mr-5 mb-3">
                    Add
                </button>
            </NuxtLink>
        </div>
        <div class="hidden md:flex md:justify-center">
            <NuxtLink :to="`/contacts/create-update/new`">
                <button class="button px-20 mt-7 mb-3">
                    Add new contacts
                </button>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
    import { useContactsStore } from '~/stores/contactsStore';

    const contactsStore = useContactsStore();

    onBeforeMount(async () => {
        try {
            await contactsStore.getUserContacts();
        }
        catch(error) {
            let errorText = document.getElementById('errorText'); 
            errorText.hidden = false;
            errorText.innerText = error.message;
        }
    })
</script>