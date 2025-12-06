import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard({ tracks }) {
    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        My Sound Profile
                    </h2>
                    <a 
                        href={route('spotify.login')} 
                        className="rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-600 transition"
                    >
                        Sync with Spotify
                    </a>
                </div>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            
                            {tracks.length === 0 ? (
                                <p className="text-center text-gray-500">No tracks found. Please sync with Spotify.</p>
                            ) : (
                                <div className="overflow-x-auto">
                                    <table className="min-w-full text-left text-sm whitespace-nowrap">
                                        <thead className="uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                            <tr>
                                                <th className="px-6 py-4">Track</th>
                                                <th className="px-6 py-4">Artist</th>
                                                <th className="px-6 py-4">Popularity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {tracks.map((track) => (
                                                <tr key={track.music_id} className="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td className="px-6 py-4 font-medium">{track.name}</td>
                                                    <td className="px-6 py-4">{track.artist}</td>
                                                    <td className="px-6 py-4">{track.popularity}</td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            )}

                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
