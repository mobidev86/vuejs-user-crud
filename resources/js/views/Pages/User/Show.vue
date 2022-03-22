<template>
  <div class="w-full md:max-w-7xl md:mx-auto flex justify-between mb-4">
    <div></div>
    <BaseButton @click="router.push({ name: 'User' })"
      >List All Users</BaseButton
    >
  </div>

  <BaseCard>
    <div class="p-6 relative" ref="loadingContainer">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">First Name</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.first_name }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Last Name</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.last_name }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Email</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.email }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">DOB</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.dob }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Age</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.age }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Home Phone</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.home_phone }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Mobile Phone</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.mobile_phone }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Street</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.street }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">City</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.city }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">State</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.state }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Zipcode</dt>
          <dd class="mt-1 text-sm text-gray-900">
            {{ user.zipcode }}
          </dd>
        </div>
      </dl>
    </div>
  </BaseCard>
</template>

<script>
export default {
  name: "UserShow",
};
</script>

<script setup>
import { onMounted, inject, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";

const route = useRoute();
const router = useRouter();
const store = useStore();

const $loading = inject("$loading");

const loadingContainer = ref(false);

const user = reactive({});

const getItem = async () => {
  let loader = $loading.show({ container: loadingContainer.value });
  await store
    .dispatch("user/get", {
      uuid: route.params.uuid,
    })
    .then((response) => {
      loader.hide();
      Object.assign(user, response);
    })
    .catch((e) => {
      loader.hide();
      router.push({ name: "User" });
    });
};

onMounted(async () => {
  await getItem();
});
</script>
