import { defineStore } from "pinia";
import { API_KEY_STORAGE_NAME } from "~/constants";

export const useContactsStore = defineStore('contactsStore', () => {
    const config = useRuntimeConfig();
    const apiRoute = config.public.apiUrl + 'contacts';

    const userContacts = ref([]);
    const searchContactsValue = ref('');

    const filteredContacts = computed(() => {
        if(userContacts.value.length == 0) {
            return [];
        }

        return userContacts.value.filter(c => c.name.toUpperCase().includes(searchContactsValue.value.toUpperCase()));
    });
        
    async function getUserContacts() {
        let userKey = localStorage.getItem(API_KEY_STORAGE_NAME);
        let response = await $fetch(apiRoute, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit',
            onRequestError() {
                throw new Error("An unexpected error has occurred while trying to retrieve user contacts");
            },
            onResponseError() {
                throw new Error("An unexpected error has occurred while trying to retrieve user contacts");
            }
        });
        userContacts.value = response.contacts;
    }

    function getContactById(id) {
        return userContacts.value.filter(c => c.id == id)[0];
    }

    async function editContact(contactId, contactInfo) {
        let userKey = localStorage.getItem(API_KEY_STORAGE_NAME);
        let routeWithId = apiRoute + '/' + contactId;

        let response = await $fetch(routeWithId, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit',
            body: contactInfo,
            onRequestError() {
                throw new Error("An unexpected error has occurred while trying to update contact");
            },
            onResponseError() {
                throw new Error("An unexpected error has occurred while trying to update contact");
            }
        });

        let updatedContact = response.contact;
        userContacts.value = userContacts.value.filter(c => c.id != updatedContact.id);
        userContacts.value.push(updatedContact);
    }

    async function createContact(contactInfo) {
        let userKey = localStorage.getItem(API_KEY_STORAGE_NAME);

        let response = await $fetch(apiRoute, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit',
            body: contactInfo,
            onRequestError() {
                throw new Error("An unexpected error has occurred while trying to add contact");
            },
            onResponseError() {
                throw new Error("An unexpected error has occurred while trying to add contact");
            }
        });
    }

    return {userContacts, searchContactsValue, filteredContacts, getUserContacts, getContactById, editContact, createContact};
})