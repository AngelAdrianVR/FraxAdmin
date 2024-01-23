<template>
    <div class="overflow-x-auto text-xs lg:text-sm">
        <table class="mb-2">
            <thead>
                <tr class="text-left">
                    <th>ID</th>
                    <th>Área reservada</th>
                    <th>Fecha</th>
                    <th>Reservado por</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="truncate min-w-[30px] max-w-[30px]">{{ '1' }}</td>
                    <td class="truncate min-w-[110px] max-w-[110px]">{{ 'Pisicina' }}</td>
                    <td class="truncate min-w-[110px] max-w-[110px]">{{ '23 octubre 2023' }}</td>
                    <td class="truncate min-w-[110px] max-w-[110px]">{{ 'Cristina Perez' }}</td>
                    <td class="truncate min-w-[110px] max-w-[110px]">{{ 'Autorizado' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    
}
</script>