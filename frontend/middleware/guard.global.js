import { API_KEY_STORAGE_NAME } from "~/constants"

export default defineNuxtRouteMiddleware(async (to, from) => {

    if(process.client) {
        let apiKey = localStorage.getItem(API_KEY_STORAGE_NAME);

        if (to.path !== '/' && (apiKey == null || apiKey == '')) {
            return abortNavigation(createError({statusCode: 401, statusMessage:'Not authenticated'}));
        }
    }
  })