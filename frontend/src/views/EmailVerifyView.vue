<template>
  <section class="h-screen flex justify-center items-center flex-col">
    <img
      src="@/assets/books/email_verify.svg"
      alt="Email Verification Picture"
    />
    <section class="email-text w-1/3">
      <div class="text-header text-center mb-2">Email Verification Sent</div>
      <p>
        We have sent an email verification to click the link in the email to
        verify.
      </p>
      <p>The email will expire in 24 hours.</p>
      <form @submit.prevent method="post" class="mt-2">
        If the email did not send. Click
        <input
          type="submit"
          name="resend"
          value="here"
          :class="[timer === 0 ? activeClass : unActiveClass]"
        />
        to send another verification email
      </form>
      <div v-show="!allowSendEmail" class="text-gray-500">
        You can only send an email after this is removed in {{ timer }} seconds
      </div>
    </section>
  </section>
</template>

<script>
import { setTitle } from "@/helpers/title";
import router from "@/router";
import store from "@/store";
import { onMounted, ref, watch, computed } from "vue";

export default {
  setup() {
    setTitle("Email Verify");
    const timer = ref(30);
    const allowSendEmail = ref(false);

    const activeClass =
      "underline hover:text-gray-500 hover:no-underline cursor-pointer";

    const unActiveClass = "text-gray-500 cursor-not-allowed";

    watch(timer, () => {
      if (timer.value !== 0) {
        setTimeout(() => {
          timer.value--;
        }, 1000);
      } else if (timer.value === 0) {
        allowSendEmail.value = true;
      }
    });

    const isVerified = computed(() => store.getters.getIsVerified);
    const isLoggedIn = computed(() => store.getters.getIsLoggedIn);

    onMounted(() => {
      if (timer.value === 30) {
        setTimeout(() => (timer.value = timer.value - 1), 1000);
      }
      if (isLoggedIn.value && isVerified.value) {
        router.push({ name: "Login" });
      }
    });

    const sendEmail = async () => {
      // await store.dispatch("AUTH_RESEND_EMAIL");
      timer.value = 0;
    };

    return {
      timer,
      allowSendEmail,
      activeClass,
      unActiveClass,
      sendEmail,
    };
  },
};
</script>
