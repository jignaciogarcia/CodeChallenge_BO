<template>
    <div class="bg-slate-50 md:bg-slate-100 h-screen md:h-full w-screen">
        <header class="h-14 md:bg-fuchsia-100 flex items-center">
            <button class="text-slate-500 ml-2 md:ml-5" @click="goBack()">&lt Back</button>
        </header>
        <div class="hidden md:pt-10 md:px-14 md:block">
            <div class="bg-gray-300 h-48 w-full rounded-xl"></div>
        </div>
        <div class="md:flex md:flex-col md:items-center">
            <div class="hidden md:flex flex-col items-center relative bottom-24 ">
                <img src="https://cdn2.iconfinder.com/data/icons/smiles-business/512/1041_boy_c-512.png"
                    class="rounded-full h-40 w-40 border-2 border-black">
                <p class="font-sans font-bold text-lg mt-8">AAAAAAA</p>
                <p class="text-slate-500">Title?</p>
            </div>
            <div class="mt-3 ml-2 mr-2 bg-slate-50 md:ml-0 md:relative md:bottom-20 md:bg-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-14 gap-y-2">
                    <div>
                        <p class="font-bold font-sans">Name</p>
                        <Field type="name" name="name" id="name" placeholder="Insert name..." v-model="contact.name" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                    <div>
                        <p class="font-bold font-sans">Address</p>
                        <Field type="address" name="address" id="address" placeholder="Insert address..." v-model="contact.address" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                    <div>
                        <p class="font-bold font-sans">Title</p>
                        <Field type="title" name="title" id="title" placeholder="Insert title..." v-model="contact.title" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                    <div>
                        <p class="font-bold font-sans">Phone</p>
                        <Field type="phone" name="phone" id="phone" placeholder="Insert phone..." v-model="contact.phone" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                    <div>
                        <p class="font-bold font-sans">Profile Picture</p>
                        <Field type="profilePic" name="profilePic" id="profilePic" placeholder="Insert picture URL..." 
                            v-model="contact.profilePictureUrl" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                    <div>
                        <p class="font-bold font-sans">Email</p>
                        <Field type="email" name="email" id="email" placeholder="Insert email..." v-model="contact.email" 
                            class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                    </div>
                </div>
                <div class="flex justify-center mt-7">
                    <div class="grid grid-cols-2 gap-x-2">
                        <button class="bg-violet-500 text-white rounded-3xl py-2.5 px-8 active:bg-violet-700 md:px-20">
                            CANCEL
                        </button>
                        <button class="bg-violet-500 text-white rounded-3xl py-2.5 px-8 active:bg-violet-700 md:px-20">
                            SAVE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useContactsStore } from '#imports';

const { id } = useRoute().params;
const contactsStore = useContactsStore();
var contact = {};

onBeforeMount(() => {
    contact = contactsStore.getContactById(id);
});
</script>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        }
    }
}
</script>