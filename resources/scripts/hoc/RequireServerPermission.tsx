import React from 'react';
import Can from '@/components/elements/Can';
import { ServerError } from '@/components/elements/ScreenBlock';

export interface RequireServerPermissionProps {
    permissions: string | string[];
}

const RequireServerPermission: React.FC<RequireServerPermissionProps> = ({ children, permissions }) => {
    return (
        <Can
            action={permissions}
            renderOnError={
                <ServerError title={'アクセス拒否'} message={'このページにアクセスする権限がありません。'} />
            }
        >
            {children}
        </Can>
    );
};

export default RequireServerPermission;
