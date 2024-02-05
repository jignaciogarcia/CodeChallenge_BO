import { defineStore } from "pinia";

export const useContactsStore = defineStore('contactsStore', () => {

    const userContacts = ref([]);
    const searchContactsValue = ref('');

    const filteredContacts = computed(() => {
        if(userContacts.value.length == 0) {
            return [];
        }

        return userContacts.value.filter(c => c.name.toUpperCase().includes(searchContactsValue.value.toUpperCase()));
    });
        
    async function getUserContacts() {
        let userKey = localStorage.getItem('APIkey');
        let response = await $fetch('http://127.0.0.1:8000/api/contacts', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit'
        });
        this.userContacts = response.contacts;
    }

    function getContactById(id) {
        return userContacts.value.filter(c => c.id == id)[0];
    }

    async function editContact(contactId, contactInfo) {
        let userKey = localStorage.getItem('APIkey');
        let routeWithId = 'http://127.0.0.1:8000/api/contacts' + '/' + contactId;

        let response = await $fetch(routeWithId, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit',
            body: contactInfo
        });
        console.log(response);
    }

    async function createContact(contactInfo) {
        let userKey = localStorage.getItem('APIkey');

        let response = await $fetch('http://127.0.0.1:8000/api/contacts', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${userKey}`
            },
            credentials: 'omit',
            body: contactInfo
        });
        console.log(response);
    }

    return {userContacts, searchContactsValue, filteredContacts, getUserContacts, getContactById, editContact, createContact};
})