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

    return {userContacts, searchContactsValue, filteredContacts, getUserContacts};
})