import { __ } from "@wordpress/i18n";
import { PanelBody } from "@wordpress/components";
import { PluginSidebar } from "@wordpress/edit-post";
import { key } from "@wordpress/icons";
import { registerPlugin } from "@wordpress/plugins";
import { useSelect, useDispatch } from "@wordpress/data";
import { TextControl } from "@wordpress/components";
const SideBar = () => {

    //Get meta value
    const { meta_key } = useSelect((select) =>
		select("core/editor").getEditedPostAttribute("meta")
	);

    //Get updater for meta
	const { editPost } = useDispatch("core/editor", [
		meta_key
	]);

	return (
		<PluginSidebar
			name=""
			title={__("")}
			icon={key}
		>
			<PanelBody>
                <TextControl
                    value={meta_key}
                    label={__( "meta_key")}
                    onChange={(newValue) => {
                        editPost({
							meta: {
								meta_key:newValue
							},
						});
                    }}
                />
			</PanelBody>
		</PluginSidebar>
	);
};

registerPlugin('', {
	render: SideBar,
});
