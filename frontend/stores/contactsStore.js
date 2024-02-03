import { defineStore } from "pinia";

export const useContactsStore = defineStore('contactsStore', () => {

    const userContacts = ref([]);

    function searchContacts(searchString) {
        return this.userContacts.filter(c => c.name.toUpperCase().includes(searchString.toUpperCase()));
    }

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

    return {userContacts, searchContacts, getUserContacts};
})