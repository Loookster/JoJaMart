<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FileInput from '@/Components/FileInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    profile_picture: null,
});

const updateProfilePicture = () => {
    form.post(route('profile-picture.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Profile Picture</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your profile picture to personalize your account.
            </p>
        </header>

        <form @submit.prevent="updateProfilePicture" class="mt-6 space-y-6">
            <div>
                <InputLabel for="profile_picture" value="Profile Picture" />

                <FileInput
                    id="profile_picture"
                    v-model="form.profile_picture"
                    class="mt-1 block w-full"
                    accept="image/*"
                />

                <InputError :message="form.errors.profile_picture" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
