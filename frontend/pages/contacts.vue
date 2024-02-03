<template>
    <div class="bg-slate-100 h-screen w-screen">
        <header class="md:h-14 bg-fuchsia-100 block"></header>
        <div class="pt-14 px-10 w-screen">
            <h1 class="font-sans font-bold text-3xl">Contacts</h1>
            <div class="mt-5 rounded p-1 shadow-x1 w-full flex bg-white">
                <img src="../assets/searchIcon.png" alt="Search icon" class="h-5 w-5">
                <input type="text" placeholder="Search contacts" class="w-full pl-3" v-model="contactsStore.searchContactsValue">
            </div>
        </div>
        <div class="my-16 lg:mx-20 lg:grid lg:grid-cols-3 lg:gap-y-4 lg:gap-x-5 xl:gap-x-16 xl:mx-40">
            <div v-for="(contact, index) in contactsStore.filteredContacts" :key="index" :class="{'bg-white': index % 2 == 0, 
                'lg:bg-slate-100': index % 2 == 0}">
                <ContactCard :contact="contact" />
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useContactsStore } from '~/stores/contactsStore';

    const contactsStore = useContactsStore();

    onBeforeMount(async () => {
        await contactsStore.getUserContacts();
    })
</script>