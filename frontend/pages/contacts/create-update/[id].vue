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
                <div v-if="id != 'new'">
                    <img :src="`${contact.profilePictureUrl}`" class="rounded-full h-40 w-40 border-2 border-black">
                    <p class="font-sans font-bold text-lg mt-8 text-center">{{ contact.name }}</p>
                    <p class="text-slate-500 text-center">Title</p>
                </div>
                <div v-else>
                    <img src="https://cdn2.iconfinder.com/data/icons/smiles-business/512/1041_boy_c-512.png"
                        class="rounded-full h-40 w-40 border-2 border-black">
                    <p class="font-sans font-bold text-lg mt-8 text-center"> Name</p>
                    <p class="text-slate-500 text-center">Title</p>
                </div>
            </div>
            <div class="mt-3 ml-2 mr-2 bg-slate-50 md:ml-0 md:relative md:bottom-20 md:bg-slate-100">
                <Form @submit="onSubmit">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-14 gap-y-2">
                        <div>
                            <p class="font-bold font-sans">Name</p>
                            <Field type="name" name="name" id="name" placeholder="Insert name..." 
                                :value="`${contact.name ? contact.name : ''}`"
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" rules="required" />
                            <ErrorMessage name="name" as="div" class="bg-red-200 border-red-500 text-red-950 
                            p-1 m-1 rounded-md shadow-md text-center" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Address</p>
                            <Field type="address" name="address" id="address" placeholder="Insert address..."
                                :value="`${contact.address ? contact.address : ''}`" 
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Title</p>
                            <Field type="title" name="title" id="title" placeholder="Insert title..."
                                :value="`${contact.title ? contact.title : ''}`" 
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Phone</p>
                            <Field type="cellphoneNumber" name="cellphoneNumber" id="cellphoneNumber" 
                                placeholder="Insert phone..."
                                :value="`${contact.cellphoneNumber ? contact.cellphoneNumber : ''}`"
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Profile Picture</p>
                            <Field type="profilePictureUrl" name="profilePictureUrl" id="profilePictureUrl" 
                                placeholder="Insert picture URL..."
                                :value="`${contact.profilePictureUrl ? contact.profilePictureUrl : ''}`"
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Email</p>
                            <Field type="email" name="email" id="email" placeholder="Insert email..."
                                :value="`${contact.email ? contact.email : ''}`" rules="email"
                                class="w-full bg-fuchsia-100 h-10 px-4 rounded block md:w-72" />
                            <ErrorMessage name="email" as="div" class="bg-red-200 border-red-500 text-red-950 
                            p-1 m-1 rounded-md shadow-md text-center" />
                        </div>
                    </div>
                    <div class="flex flex-col justify-center mt-7">
                        <CustomErrorCard id="errorText" hidden="true" />
                        <CustomSuccessCard id="successText" hidden="true" />
                        <div class="grid grid-cols-2 gap-x-2">
                            <button class="bg-violet-500 text-white rounded-3xl py-2.5 px-8 active:bg-violet-700 md:px-20"
                                @click="goBack()" type="button">
                                CANCEL
                            </button>
                            <button class="bg-violet-500 text-white rounded-3xl py-2.5 px-8 active:bg-violet-700 md:px-20">
                                SAVE
                            </button>
                        </div>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>


<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import { useContactsStore } from '#imports';
import { ADD_CONTACT_ROUTE_PARAMETER } from '~/constants';

export default {
    setup() {
        const { id } = useRoute().params;
        const contactsStore = useContactsStore();
        var contact = {};

        return {id, contactsStore, contact}
    },
    beforeMount() {
        if(this.id != ADD_CONTACT_ROUTE_PARAMETER) {
            this.contact = this.contactsStore.getContactById(this.id);
        }
    },
    components: {
        Form,
        Field,
        ErrorMessage
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        async onSubmit(values) {
            let errorText = document.getElementById('errorText');
            let successText = document.getElementById('successText');

            try {
                errorText.hidden = true;
                successText.hidden = true;
                let successMessage;

                if(this.id != ADD_CONTACT_ROUTE_PARAMETER){
                    await this.contactsStore.editContact(this.id, values);
                    successMessage = "Contact updated successfully";
                }
                else {
                    await this.contactsStore.createContact(values);
                    successMessage = "Contact added successfully";
                }

                successText.hidden = false;
                successText.innerText = successMessage;
            }
            catch(error) {
                errorText.hidden = false;
                errorText.innerText = error.message;
            }
        }
    }
}
</script>