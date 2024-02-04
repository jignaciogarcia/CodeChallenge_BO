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
        <div v-if="contactsStore.userContacts.length > 0" 
            class="mt-16 lg:mx-20 lg:grid lg:grid-cols-3 lg:gap-y-4 lg:gap-x-5 xl:gap-x-16 xl:mx-40">
            <div v-for="(contact, index) in contactsStore.filteredContacts" :key="index" :class="{'bg-white': index % 2 == 0, 
                'lg:bg-slate-100': index % 2 == 0}">
                <ContactCard :contact="contact" />
            </div>
        </div>
        <div v-else class="flex justify-center mt-20">
            <p class="font-sans font-bold text-xl text-sky-900 w-52 text-center">Add contacts to your database</p>
        </div>
        <div v-if="isSmallScreen" class="flex">
            <button class="rounded-full bg-violet-500 ml-auto active:bg-violet-700 h-12 w-12 p-1 flex justify-center items-center">
                <div>
                    <div class="w-6 h-1 bg-white"></div>
                    <div class="w-6 h-1 bg-white rotate-90"></div>
                </div>
            </button>
        </div>
        <div v-else class="flex justify-center">
            <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-20 active:bg-violet-700">
                Add new contacts
            </button>
        </div>
    </div>
</template>

<script setup>
    import { useContactsStore } from '~/stores/contactsStore';

    const contactsStore = useContactsStore();
    const isSmallScreen = ref(false);
    var updateIsSmallScreen;

    if(process.client) {
        updateIsSmallScreen = () => {
            isSmallScreen.value = window.innerWidth < 1024;
        }
        updateIsSmallScreen.call();
    }

    onBeforeMount(async () => {
        await contactsStore.getUserContacts();

        window.addEventListener('resize', updateIsSmallScreen);
    })

    onBeforeUnmount(() => {
        window.removeEventListener('resize', updateIsSmallScreen);
    })
</script>