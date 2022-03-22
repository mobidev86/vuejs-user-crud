<template>
  <div class="w-full">
    <form @submit.prevent="submit">
      <div class="relative" ref="loadingContainer">
        <div class="grid grid-cols-2 gap-6">
          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.first_name"
              name="first_name"
              label="First Name"
              v-model:error="formErrors.first_name"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.last_name"
              name="last_name"
              label="Last Name"
              v-model:error="formErrors.last_name"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="date"
              v-model="form.dob"
              name="dob"
              label="DOB"
              v-model:error="formErrors.dob"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.age"
              name="age"
              label="Age"
              v-model:error="formErrors.age"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.home_phone"
              name="home_phone"
              label="Home Phone"
              v-model:error="formErrors.home_phone"
              id="home_phone"
              maxlength = "14"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.mobile_phone"
              name="mobile_phone"
              label="Mobile Phone"
              v-model:error="formErrors.mobile_phone"
              id="mobile_phone"
              maxlength = "14"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.email"
              name="email"
              label="Email"
              v-model:error="formErrors.email"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.street"
              name="street"
              label="Street"
              v-model:error="formErrors.street"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.city"
              name="city"
              label="City"
              v-model:error="formErrors.city"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.state"
              name="state"
              label="State"
              v-model:error="formErrors.state"
            />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <BaseInput
              type="text"
              v-model="form.zipcode"
              name="zipcode"
              label="Zipcode"
              v-model:error="formErrors.zipcode"
            />
          </div>
        </div>
      </div>
      <BaseButton class="mt-2" type="submit">{{
        route.params.uuid ? "Update" : "Save"
      }}</BaseButton>
    </form>
  </div>
</template>

<script>
export default {
  name: "UserForm",
};
</script>

<script setup>
import { onMounted, computed, inject, ref, reactive, createApp } from "vue";
import { useRoute, useRouter, onBeforeRouteLeave } from "vue-router";
import { useStore } from "vuex";

const route = useRoute();
const router = useRouter();
const store = useStore();

const $loading = inject("$loading");

const loadingContainer = ref(false);

const initForm = {
  first_name: "",
  last_name: "",
  email: "",
  dob: "",
  age: "",
  home_phone: "",
  mobile_phone: "",
  street: "",
  city: "",
  state: "",
  zipcode: "",
};

const formErrors = computed(() => store.getters["user/getFormErrors"]);

const form = reactive({ ...initForm });

const submit = async () => {
  let loader = $loading.show({ container: loadingContainer.value });
  let action = route.params.uuid ? "update" : "create";
  console.log(action);
  await store
    .dispatch("user/" + action, {
      form,
      uuid: route.params.uuid,
    })
    .then((response) => {
      loader.hide();
      router.push({ name: "User" });
    })
    .catch((e) => {
      loader.hide();
    });
};

const getItem = async () => {
  let loader = $loading.show({ container: loadingContainer.value });
  await store
    .dispatch("user/get", {
      uuid: route.params.uuid,
    })
    .then((response) => {
      loader.hide();
      Object.assign(form, response);
    })
    .catch((e) => {
      loader.hide();
      router.push({ name: "User" });
    });
};

const resetFormErrors = () => {
  store.dispatch("user/resetFormErrors");
};

onMounted(async () => {
  if (route.params.uuid) {
    await getItem();
  }
});

onBeforeRouteLeave((to, from) => {
  resetFormErrors();
});

$(document).on("keyup", "#home_phone", function () {
    var phoneNumberString = $(this).val();
    phoneNumberString = phoneNumberString.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    $(this).val(phoneNumberString);
});

$(document).on("keyup", "#mobile_phone", function () {
    var phoneNumberString = $(this).val();
    phoneNumberString = phoneNumberString.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    $(this).val(phoneNumberString);
});

</script>
