import { defineRule } from 'vee-validate';
import { email } from '@vee-validate/rules';

export default defineNuxtPlugin(nuxtApp => {
  defineRule('email', value => {
    if(email(value) !== true) {
      return 'The field above must be a valid email.'
    }

    return true;
  });

  defineRule('required', value => {
    if(!value || !value.length) {
      return 'The field above cannot be empty.'
    }

    return true;
  });
})