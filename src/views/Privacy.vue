<script setup>
import { useRouter } from 'vue-router';
import Container from '../components/layout/Container.vue';
import PageLayout from '../components/layout/PageLayout.vue';

const router = useRouter();

</script>

<template>
    <PageLayout>
        <div class="w-full flex-1 flex-col gap-5 py-10 px-5 items-start inline-flex justify-start">
            <div class="w-full inline-flex items-center justify-center">
                <img src="/logos/icon.webp" class="w-64" alt="wild pitch icon"/>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">1. Introduction</div>
                <div>Welcome to Wild Pitch! We are committed to respecting and protecting your privacy. This Privacy Policy is designed to help you understand how we collect, use, disclose, and safeguard your personal information. By using our website, you consent to the practices described in this Privacy Policy.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">2. Information We Collect</div>
                <div>User Account Information: When you create an account with Wild Pitch, we collect your name and email address to provide our services to you.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">3. How We Use Your Information</div>
                <div>Service Delivery: We use your name and email address to create and manage your user account, allowing you to access our services and interact with our platform.</div>
                <div>Communication: We may use your email address to send important account-related notifications, updates, and promotional messages.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">4. Data Storage</div>
                <div>Your name and email address will be securely stored on our servers. We take reasonable measures to protect your data from unauthorized access, disclosure, or alteration.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">5. Data Deletion</div>
                <div>You have the right to request the deletion of your account and associated data. Upon receiving such a request, we will permanently delete your data within a reasonable time frame, subject to legal and regulatory requirements. Please note that some information may be retained for backup or legal compliance purposes.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">6. Third-Party Services</div>
                <div>Wild Pitch may use third-party services for analytics, advertising, or other purposes. These services may collect and use data in accordance with their own privacy policies. We are not responsible for the privacy practices of these third parties.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">7. Cookies and Tracking</div>
                <div>Wild Pitch may use cookies and similar tracking technologies to improve the user experience and better understand how users interact with our website.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">8. Changes to this Privacy Policy</div>
                <div>We reserve the right to update this Privacy Policy to reflect changes to our information practices. Any revisions will be effective upon posting the updated Privacy Policy on our website. We encourage you to review this policy periodically.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">9. Contact Us</div>
                <div>If you have any questions or concerns about this Privacy Policy or the handling of your data, please contact us at jamesrmorey@gmail.com.</div>
            </div>
            <div class="inline-flex flex-col gap-2">
                <div class="text-3xl font-bold">10. Legal Compliance</div>
                <div>This Privacy Policy is subject to the laws and regulations applicable in the UK</div>
            </div>
        </div>
    </PageLayout>
</template>
