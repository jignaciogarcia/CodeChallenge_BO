import { defineRule } from 'vee-validate';
import { required, email } from '@vee-validate/rules';

export default defineNuxtPlugin(nuxtApp => {
    defineRule('email', email);
    defineRule('required', required);
  })