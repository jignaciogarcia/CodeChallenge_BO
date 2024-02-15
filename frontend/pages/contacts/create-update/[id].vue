<template>
    <div class="bg-slate-50 md:bg-slate-100 h-full min-h-screen w-screen">
        <header class="h-14 md:bg-fuchsia-100 flex items-center">
            <button class="text-slate-500 ml-2 md:ml-5" @click="goBack()">&lt Back</button>
        </header>
        <div class="hidden md:pt-10 md:px-14 md:block">
            <div class="bg-gray-300 h-48 w-full rounded-xl"></div>
        </div>
        <div class="md:flex md:flex-col md:items-center">
            <div class="hidden md:flex flex-col items-center relative bottom-24 ">
                <div v-if="id != 'new'">
                    <img :src="`${contact.profilePictureUrl ? contact.profilePictureUrl : DEFAULT_PROFILE_PICTURE}`" 
                    class="rounded-full h-40 w-40 border-2 border-black">
                    <p class="font-sans font-bold text-lg mt-8 text-center">{{ contact.name }}</p>
                    <p class="text-slate-500 text-center">{{ contact.title }}</p>
                </div>
                <div v-else>
                    <img :src="DEFAULT_PROFILE_PICTURE"
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
                                class="createUpdateInput" rules="required" />
                            <ErrorMessage name="name" as="div" class="errorMessage" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Address</p>
                            <input v-if="id == ADD_CONTACT_ROUTE_PARAMETER" type="text" name="address" id="address" 
                                ref="addressRef" class="createUpdateInput" placeholder="Insert address..." />
                            <Field v-else type="address" name="address" id="address" placeholder="Insert address..."
                                :value="contact.address" class="createUpdateInput" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Title</p>
                            <Field type="title" name="title" id="title" placeholder="Insert title..."
                                :value="`${contact.title ? contact.title : ''}`" 
                                class="createUpdateInput" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Phone</p>
                            <Field type="cellphoneNumber" name="cellphoneNumber" id="cellphoneNumber" 
                                placeholder="Insert phone..."
                                :value="`${contact.cellphoneNumber ? contact.cellphoneNumber : ''}`"
                                class="createUpdateInput" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Profile Picture</p>
                            <Field type="profilePictureUrl" name="profilePictureUrl" id="profilePictureUrl" 
                                placeholder="Insert picture URL..."
                                :value="`${contact.profilePictureUrl ? contact.profilePictureUrl : ''}`"
                                class="createUpdateInput" />
                        </div>
                        <div>
                            <p class="font-bold font-sans">Email</p>
                            <Field type="email" name="email" id="email" placeholder="Insert email..."
                                :value="`${contact.email ? contact.email : ''}`" rules="email"
                                class="createUpdateInput" />
                            <ErrorMessage name="email" as="div" class="errorMessage" />
                        </div>
                    </div>
                    <div class="flex flex-col justify-center mt-7">
                        <p id="infoText" hidden="true" :class="{
                            'successMessage': !infoTextIsError,
                            'errorMessage': infoTextIsError 
                        }"></p>
                        <div class="grid grid-cols-2 gap-x-2">
                            <button class="button px-8 md:px-20"
                                @click="goBack()" type="button">
                                CANCEL
                            </button>
                            <button class="button px-8 md:px-20">
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
import { ADD_CONTACT_ROUTE_PARAMETER, DEFAULT_PROFILE_PICTURE } from '~/constants';

export default {
    setup() {
        const { id } = useRoute().params;
        const contactsStore = useContactsStore();
        const contact = ref({});
        const infoTextIsError = ref(false);
        const addressRef = ref(null);

        const config = useRuntimeConfig();
        let googleApiKey = config.public.googleApiKey;
        const src = "https://maps.googleapis.com/maps/api/js?key=" + googleApiKey +"&libraries=places";

        onBeforeMount(() => {
            if(id != ADD_CONTACT_ROUTE_PARAMETER) {
                contact.value = contactsStore.getContactById(id);
            };
        });

        onMounted(() => {
            if(id == ADD_CONTACT_ROUTE_PARAMETER) {
                let script = document.querySelector(`script[src="${src}"]`);

                if(!script) {
                    script = document.createElement('script');
                    script.src = src;
                    document.head.append(script);

                    script.addEventListener('load', () => {
                        new google.maps.places.Autocomplete(addressRef.value);
                    });
                }
                else {
                    new google.maps.places.Autocomplete(addressRef.value);
                }
            }
        });

        return {id, contactsStore, contact, infoTextIsError, addressRef, ADD_CONTACT_ROUTE_PARAMETER}
    },
    components: {
        Form,
        Field,
        ErrorMessage
    },
    data() {
        return {DEFAULT_PROFILE_PICTURE}
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        async onSubmit(values) {
            let infoText = document.getElementById('infoText');

            if(this.id == ADD_CONTACT_ROUTE_PARAMETER) {
                let address = this.addressRef.value;
                values.address = address;
            }

            try {
                this.infoTextIsError = false;
                infoText.hidden = true;
                let infoTextMessage;

                if(this.id != ADD_CONTACT_ROUTE_PARAMETER){
                    await this.contactsStore.editContact(this.id, values);
                    infoTextMessage = "Contact updated successfully";
                }
                else {
                    await this.contactsStore.createContact(values);
                    infoTextMessage = "Contact added successfully";
                }

                infoText.hidden = false;
                infoText.innerText = infoTextMessage;
            }
            catch(error) {
                this.infoTextIsError = true;
                infoText.hidden = false;
                infoText.innerText = error.message;
            }
        }
    }
}
</script>